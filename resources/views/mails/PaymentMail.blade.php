<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'DejaVuSans';
            src: url('{{ public_path('fonts/DejaVuSans.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body {
            font-family: 'DejaVuSans', sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .invoice-head td {
            padding: 0 8px;
        }
        .invoice-body {
            margin-top: 20px;
        }
        #customers {
            border-collapse: collapse;
            width: 100%;
        }
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="span4">
            <address>
                <?php
                    $products = Session::get('products');
                    $total = Session::get('total');
                    $without_discount_price = Session::get('without_discount_price');
                    $discount_price = Session::get('discount_price');
                    $extra_charge = Session::get('extra_charge');
                    $qrcode = Session::get('qrcode');
                    $invoice = Session::get('invoice');
                    $date = Session::get('date');
                    $pay_method = Session::get('pay_method'); // Lấy phương thức thanh toán từ session
                ?>
            </address>
        </div>
        <center><h1>Nhà hàng HT</h1></center>
        <img src="data:image/png;base64, {!! $qrcode !!}" style="margin-left:570px;">
        <div class="span4 well">
            <table class="invoice-head" style="margin-left:20px;font-size:18px;">
                <tbody>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Mã đơn hàng</strong></td>
                        <td style="text-align:left">: {{ $invoice }}</td>
                    </tr>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Tên khách hàng</strong></td>
                        <td style="text-align:left">: {{ Auth::user()->name }}</td>
                    </tr>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Email</strong></td>
                        <td style="text-align:left">: {{ Auth::user()->email }}</td>
                    </tr>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Trạng thái</strong></td>
                        <td style="text-align:left">: {{ $pay_method === 'VNPay' ? 'Đã thanh toán ' : 'Chưa thanh toán' }}</td>
                    </tr>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Phương thức thanh toán</strong></td>
                        <td style="text-align:left">: {{ $pay_method === 'VNPay' ? 'VNPay ' : 'Tiền mặt' }}</td>
                    </tr>
                    <tr style="text-align:left">
                        <td class="pull-right"><strong>Ngày đặt đơn</strong></td>
                        <td style="text-align:left">: {{ $date }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="span8">
            <h2 style="margin-left:20px;">Chi tiết sản phẩm</h2>
        </div>
    </div>
    <div class="row">
        <div class="span8 well invoice-body">
            <table class="table table-bordered" id="customers" style="border:2px solid;margin-left:20px;margin-right:20px !important;width:95%!important;">
                <thead>
                    <tr style="border:2px solid;text-align:center;">
                        <th style="text-align:center;">Tên sản phẩm</th>
                        <th style="margin-left:20px;text-align:center;">Giá</th>
                        <th style="margin-left:20px;text-align:center;">Số lượng</th>
                        <th style="margin-left:20px;text-align:center;">Giá gốc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border:2px solid;">
                        <td style="margin-left:20px;">{{ $product->name }}</td>
                        <td style="margin-left:20px;">{{ $product->price }}</td>
                        <td style="margin-left:20px;">{{ $product->quantity }}</td>
                        <td style="margin-left:20px;">{{ $product->subtotal }} VNĐ</td>
                    </tr>
                    @endforeach
                    @foreach($extra_charge as $charge)
                    <tr style="border:2px solid;">
                        <td style="margin-left:20px;">{{ $charge->name }}</td>
                        <td style="margin-left:20px;"></td>
                        <td style="margin-left:20px;"></td>
                        <td style="margin-left:20px;">{{ $charge->price }} VNĐ</td>
                    </tr>
                    @endforeach
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td><strong>Tổng</strong></td>
                        <td><strong>{{ $without_discount_price }} VNĐ</strong></td>
                    </tr>
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td><strong>Giảm giá</strong></td>
                        <td><strong>{{ $discount_price }} VNĐ</strong></td>
                    </tr>
                    <tr><td colspan="4"></td></tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                        <td><strong>Tổng tiền</strong></td>
                        <td><strong>{{ $total }} VNĐ</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <br>
    <div class="row" style="margin-left:20px;">
        <div class="span3" style="font-size:16px;">
            <strong>RMS Admin</strong>
        </div>
        <br>
        <div class="span3">
            <strong>Số điện thoại:</strong>0123456789
        </div>
        <div class="span3">
            <strong>Email:</strong> <a href="mailto:thuongcth03@gmail.com">thuongcth03@gmail.com</a>
        </div>
    </div>
</div>
</body>
</html>
