@extends('layout', ['title'=> 'Home'])

@section('page-content')
<div>
    <br>
    <br>
    <br>
    <br>
    <center>


    <h1>Đơn hàng của tôi</h1>

    <br>
    <br>


    </center>
<table id="cart" class="table table-hover table-condensed container">
    <thead>
        <tr>
            <th style="width:10%">Ngày</th>
            <th style="width:10%">Mã đơn hàng</th>
            <th style="width:30%">Sản phẩm</th>
            <th style="width:20%">Phương thức thanh toán</th>
            <th style="text-align:center;width:10%">Price</th>
            <th style="width:8%">Số lượng</th>
            <th style="width:30%" class="text-center">Tổng tiền</th>
            
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @foreach($carts as $product)
            @php $total += $product['price'] * $product['quantity'] @endphp
            <tr>
                <td>{{$product->purchase_date}}</td>
                <td>{{$product->invoice_no}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->pay_method}}</td>
                <td style="text-align:center">{{  number_format($product->price, 0, ',', '.')  }} đ</td>
                <td style="text-align:center">{{$product->quantity}}</td>
                <td style="text-align:center">{{  number_format($product->subtotal, 0, ',', '.')  }} đ</td>
              
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
        @php 
        
        
        $total = $total_price;
        
        Session::put('total',$total_price);
        
        @endphp
            <td colspan="7" class="text-right"><h3><strong>Tổng {{  number_format($total_price, 0, ',', '.')  }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="7" class="text-right">
                <a href="{{ url('/menu') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục đặt hàng</a>
              
            </td>
        </tr>
    </tfoot>
</table>
</div>
@endsection