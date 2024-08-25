<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VnPayReturnController extends Controller
{
    public function handleReturn(Request $request)
    {
        $vnp_TmnCode = "TPVSSOWF"; // Your VNPAY store code
        $vnp_HashSecret = "SIEZ18DGMJVC39XKVX20W22374J9FJW9"; // Your VNPAY secret key

        $vnp_SecureHash = $request->input('vnp_SecureHash');
        unset($request['vnp_SecureHash']);

        $queryData = "";
        foreach ($request->except(['vnp_SecureHash']) as $key => $value) {
            $queryData .= urlencode($key) . "=" . urlencode($value) . "&";
        }
        $queryData = rtrim($queryData, '&');

        $secureHash = hash_hmac('sha512', $queryData, $vnp_HashSecret);

        if ($secureHash === $vnp_SecureHash) {
            // Payment successful
            // You can handle successful payment here
        } else {
            // Payment failed
        }
    }
}
