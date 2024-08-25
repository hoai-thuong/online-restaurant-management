@extends('layout', ['title'=> 'Home'])

@section('page-content')
<div style="width:80%; margin:auto;">
    <br>
    <br>
    <br>
    <br>
    <h1>Số tiền đặt hàng của bạn là {{  number_format($total, 0, ',', '.')  }} đ</h1><br>
    <h2 style="color:#FB5849">Lựa chọn phương thức thanh toán</h2><br>
    <input ng-model="myVar" type="radio" id="cod" name="cod" value="cod">
    <label for="cod"><img style="max-width:150px;" src="{{ asset('assets/images/cod.png')}}"></label><br>
    <input ng-model="myVar" type="radio" id="bkash" name="bkash" value="bkash">
    <label for="bkash"><img style="max-width:150px;"  src="{{ asset('assets/images/vnpay.jpg')}}"></label><br><br><br>
    <div ng-switch="myVar">
        @if (Auth::check())
            <div ng-switch-when="cod">
             
                <form style="display:inline"  method="post" action="{{route('mails.shipped', $total)}}">
                @csrf
                    <input class="btn btn-success" type="submit" value="Thanh toán tiền mặt">
                </form>
            </div>
            <div ng-switch-when="bkash">
            <?php
                Session::put('total',$total);
            ?>
            <a href="/ssl/pay"><input class="btn btn-success" type="submit" value="Thanh toán VNPAY"></a>
                 
                <!-- @include('bkash-script') -->
            </div>
        @else
            <div ng-switch-when="cod">
               
            </div>
            <div ng-switch-when="bkash">
                <a href="/login"><input class="btn btn-success" type="submit" value="Log in"></a>
            </div>
        @endif
    </div>
     <br>
    <!-- Nút quay lại -->
    <a href="{{ url()->previous() }}" class="btn" style="margin: 10px;">Quay lại</a>
</form>
</div>
@endsection
