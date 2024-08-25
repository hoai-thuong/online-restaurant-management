@extends('layout', ['title'=> 'Home'])

@section('page-content')
<div>
    <br>
    @if(Session::has('wrong'))
    <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Opps !</strong> {{Session::get('wrong')}}
</div>
    @endif
    @if(Session::has('success'))
    <br>
    <div class="success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Congrats !</strong> {{Session::get('success')}}
</div>
    <br>
    @endif
    <br>
    
    <br>
    <br>
    
<table id="cart" class="table table-hover table-condensed container">
    <thead>
        <tr>
            <th style="width:50%">Sản phẩm</th>
            <th style="text-align:center;width:10%">Giá</th>
            <th style="width:8%">Số lượng</th>
            <th style="width:22%" class="text-center">Tổng phụ</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @foreach($carts as $product)
            @php $total += $product['price'] * $product['quantity'] @endphp
            <tr>
                <td>{{$product->name}}</td>
                <td style="text-align:center"> {{ number_format($product->price,  0, ',', '.') }} đ</td>
                
                <td style="text-align:center">{{$product->quantity}}</td>
                <td style="text-align:center"> {{ number_format($product->subtotal, 0, ',', '.') }} đ</td>
                <td style="text-align:center" class="actions" data-th="">
                    <form method="post" action="{{route('cart.destroy', $product)}}" onsubmit="return confirm('Sure?')">
                        @csrf
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash">
                        </i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    
  
      @if($total_price!=0)


            @foreach($extra_charge as $chrage)
            <tr>
                <td>{{  $chrage->name }}</td>
                <td style="text-align:center"></td>
                <td style="text-align:center"></td>
                
              
                <td style="text-align:center"> {{ number_format($chrage->price, 0, ',', '.') }} đ</td>


        
                </tr>
            @endforeach



      @endif
        @php 
        

        
        @endphp
        </tbody>
    <tfoot>
        <form method="post" action="{{route('coupon/apply')}}">
            @csrf    

            @if($total_price==0)
            <td colspan="3" class="text-right" ><strong>  <p style="margin-top:8px !important;">Mã khuyến mãi</p> </strong></td>
            <td>  <input type="text" name="code" class="form-control" id="exampleFormControlInput1" placeholder=""></td>
            <td> <button type="submit" class="btn btn-dark" disabled>Áp dụng</button> </td>
            @endif
            @if($total_price!=0)
            <td colspan="3" class="text-right" ><strong>  <p style="margin-top:8px !important;">Mã khuyến mãi</p> </strong></td>
            <td>  <input type="text" name="code" class="form-control" id="exampleFormControlInput1" placeholder=""></td>
            <td> <button type="submit" class="btn btn-dark">Áp dụng</button> </td>
            @endif
</form>
        </tr>
        <tr>
        @php 
        
        
        $total = $total_price + $total_extra_charge;
        
        Session::put('total',$total_price);


        if($total_price!=0)
        {
        

            // Perform the addition
            $total_price = $total_price + $total_extra_charge;

            // Debugging output to check the result



            $without_discount_price=$without_discount_price + $total_extra_charge;


        }




        
        @endphp
       
            <td colspan="5" class="text-right"><h5><strong> Tổng {{ number_format($without_discount_price, 0, ',', '.')  }}</strong></h5></td>


        </tr>
        <tr>
  
            <td colspan="5" class="text-right"><h5><strong>Giảm giá    {{ number_format($discount_price, 0, ',', '.')  }}</strong></h5></td>
        </tr>
        <tr>
      
            <td colspan="5" class="text-right"><h3><strong>Tổng (Sau khi giảm) {{  number_format($total_price, 0, ',', '.')  }}</strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/menu') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Tiếp tục đặt hàng</a>
                <form style="display:inline" method="post" action="{{route('cart.checkout', $total)}}">
                    @csrf
                    @if($total_price==0)
                    <button class="btn btn-success" disabled>Thanh toán</button>
                    @else
                    <button class="btn btn-success">Thanh toán</button>
                    @endif
                </form>
            </td>
        </tr>
    </tfoot>
</table>
</div>
@endsection


<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}


.success {
  padding: 20px;
  background-color: #4BB543;
  color: white;
}


.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>