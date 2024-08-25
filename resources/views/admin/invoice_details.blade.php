@extends('admin/adminlayout')

@section('container')

<br>

@if(Session::has('wrong'))

    <div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Opps !</strong> {{Session::get('wrong')}}
</div>
<br>
    @endif
    @if(Session::has('success'))

    <div class="success">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
  <strong>Congrats !</strong> {{Session::get('success')}}
</div>
    <br>
    @endif


@foreach($products as $product)
<div class="card">
  <h5 class="card-header">Thông tin chi tiết khách hàng</h5>
  <div class="card-body">
    <h5 class="card-text">Mã đơn hàng: {{  $product->invoice_no }}</h5>
    <br>
    <?php


        $user=DB::table('users')->where('id',$product->user_id)->first();

    ?>
    <p class="card-text">Tên khách hàng : {{ $user->name }}</p>
    <p class="card-text">Số điện thoại khách hàng : {{ $user->phone }}</p>
    <p class="card-text">Email khách hàng : {{ $user->email }}</p>
    <p class="card-text">Địa chỉ giao hàng : {{ $product->shipping_address }}</p>
    <a href="/customer" class="btn btn-primary"><b>Details</a>
  </div>
</div>

@break;




@endforeach


<br>




<div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Chi tiết sản phẩm</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
           
                            <th> Tên sản phẩm </th>
                            <th> Giá </th>
                            <th> Số lượng </th>
                            <th> Tổng </th>
                          
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                          <tr>
                           
                      
                            <td> {{ $product->name }} </td>
                            <td> {{  number_format($product->price, 0, ',', '.')  }} đ</td>
                            <td>


                            {{ $product->quantity }}


                            </td>


                            <td>  {{  number_format($product->subtotal, 0, ',', '.')  }} đ</td>
                      
                          </tr>

                        @endforeach

                        @foreach($extra_charge as $charge)
                          <tr>
                           
                      
                            <td> {{ $charge->name }} </td>
                      
                           <td>

                           </td>
                           <td></td>


                            <td> {{  number_format($charge->price, 0, ',', '.')  }} đ</td>
                      
                          </tr>

                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Tổng </td>
                            <td class=""> {{  number_format($wihout_discount_price, 0, ',', '.')  }} đ</td>                   
                            
                    
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td>Giảm giá </td>
                            <td class="">                             {{  number_format($discount_price, 0, ',', '.')  }} đ               
                            </td>    
                    
                    
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td><h3>Tổng (Sau giảm giá ) </h3> </td>
                            <td class=""><h3>                              {{  number_format($total_price, 0, ',', '.')  }} đ               
                            </h3></td>                   
                    
                    
                        </tr>
                       
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              @foreach($products as $product)
              @if($product->product_order=="yes")
<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Xử lý</h4>
                  
                    
          
                    <form class="forms-sample" action="{{ url('/invoice/approve/'.$product->invoice_no) }}" method="post">
    @csrf

    <div class="form-group">
        <label for="deliveryStaff">Nhân viên giao hàng</label>
        <select name="delivery_staff" id="deliveryStaff" class="form-control">
            <option value="">Chọn nhân viên giao hàng</option>
            @foreach($deliveryStaff as $staff)
                <option value="{{ $staff->id }}">{{ $staff->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="deliveryTime">Thời gian giao hàng</label>
        <input type="datetime-local" name="time" class="form-control" id="deliveryTime">
    </div>

    <button type="submit" class="btn btn-primary me-2">Chấp nhận đơn hàng</button>
    <a href="{{ asset('/invoice/cancel-order/'.$product->invoice_no) }}" class="btn btn-danger">Huỷ đơn</a>
</form>


                    @break;

   

                  </div>
                </div>

            </div>



            @endif
            @endforeach


         




@endsection()



<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
}

.success {
  padding: 20px;
  background-color: #4BB543 ;
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

<script>
    // Get the current date and time
    const now = new Date();

    // Format the date and time to match the required format for datetime-local input
    const formattedDateTime = now.toISOString().slice(0, 16);

    // Set the value of the input field to the current date and time
    document.getElementById('exampleInputName1').value = formattedDateTime;
</script>