<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mpdf\Mpdf;
class VNPayController extends Controller
{
    public function vnpay_payment(Request $request){
        // dd("id User", Auth::user()->id);
        $shipping_address = $request->input('address', 'N/A');
        // Session::put('shipping_address', $shipping_address);
    
        // Kiểm tra dữ liệu trong session
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "http://localhost:8000/my-order";
        // $vnp_Returnurl = "http://localhost:8000/vnpay-return";
        $vnp_Returnurl = "http://localhost:8000/vnpay-return?shipping_address=" . urlencode($shipping_address);

        $vnp_TmnCode = "TPVSSOWF";//Mã website tại VNPAY 
        $vnp_HashSecret = "SIEZ18DGMJVC39XKVX20W22374J9FJW9"; //Chuỗi bí mật

        $vnp_TxnRef = uniqid(); // Unique transaction reference
        $vnp_OrderInfo = 'Thanh toan don hang test ';
        $vnp_OrderType = 'Online Payment';
        $vnp_Amount = $request->input('amount') * 100; 
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashdata = rtrim($hashdata, '&');
        
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= "?" . $hashdata . '&vnp_SecureHash=' . $vnpSecureHash;

        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode(['code' => '00', 'message' => 'success', 'data' => $vnp_Url]);
        }
    }

    public function vnpay_return(Request $request)
    {
        // dd(Session::get('shipping_address'));
        $shipping_address = $request->query('shipping_address', 'N/A');
        // dd($shipping_address);
        // dd($request->all());
        $vnp_HashSecret = "SIEZ18DGMJVC39XKVX20W22374J9FJW9"; // Chuỗi bí mật
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = $request->except('vnp_SecureHash', 'vnp_SecureHashType');
        ksort($inputData);
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashdata = rtrim($hashdata, '&');
        $invoice = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 8);
        
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        
        if ($request->vnp_ResponseCode == '00') {
            // Payment successful, update the database
                      // Lưu phương thức thanh toán vào session
    
            $data = [
                'shipping_address' => $shipping_address,
                'product_order' => "yes",
                // 'invoice_no' => $request->vnp_TxnRef,
                'invoice_no' => $invoice,

                'pay_method' => "VNPay",
                'delivery_time' => "3 hours",
                'purchase_date' => date("Y-m-d"),
            ];
    
            $products = DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_order', 'no')
                ->get();
    
            $total = DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_order', 'no')
                ->sum('subtotal');
    
            $carts_amount = DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_order', 'no')
                ->count();
    
            $discount_price = 0;
            $coupon_code = null;
    
            if ($carts_amount > 0) {
                foreach ($products as $cart) {
                    $coupon_code = $cart->coupon_id;
                }
            }
    
            if ($coupon_code != null) {
                $coupon_code_price = DB::table('coupons')
                    ->where('code', $coupon_code)
                    ->value('percentage');
    
                $discount_price = floor(($total * $coupon_code_price) / 100);
                $total -= $discount_price;
            }
            $carts = DB::table('carts')
                ->where('user_id', Auth::user()->id)
                ->where('product_order', 'no')
                ->update($data);
    
            $extra_charge = DB::table('charges')->get();
            $total_extra_charge = DB::table('charges')->sum('price');
            $total += $total_extra_charge;


            $paymethod = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->value('pay_method');
        
            Session::put('pay_method', $paymethod);
            Session::put('products', $products);
            Session::put('invoice', $invoice);
            Session::put('total', $total);
            Session::put('extra_charge', $extra_charge);
            Session::put('discount_price', $discount_price);
            Session::put('without_discount_price', $total + $discount_price);
            Session::put('date', date("Y-m-d"));
    
            if ($carts) {
                $details = [
                    'title' => 'Mail from RMS Admin',
                    'body' => 'Your order has been placed successfully. Your order Invoice no - ' . $request->vnp_TxnRef,
                ];
    
                $qrcode = base64_encode(QrCode::format('svg')->size(100)->errorCorrection('H')->generate('RMS Verified'));
                $pdf = PDF::loadView('mails.PaymentMail', $data);
    
                Session::put('qrcode', $qrcode);
    
                Mail::send('mails.PaymentMail', $details, function ($message) use ($details, $pdf) {
                    $message->to(Auth::user()->email)
                        ->subject($details['title'])
                        ->attachData($pdf->output(), "Order Copy.pdf");
                });

                // Chuyển hướng đến URL mong muốn sau khi xử lý thành công
                return redirect('http://localhost:8000/my-order');
            }
        } else {
            return redirect('http://localhost:8000/menu')
            ->with('error', 'Thanh toán không thành công. Vui lòng thử lại.');
        }
    }
    
    
}
