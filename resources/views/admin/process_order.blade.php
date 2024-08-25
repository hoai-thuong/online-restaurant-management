@extends('admin/adminlayout')

@section('container')





<div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Chi tiết sản phẩm đang giao</h4>

                    @if(Session::has('wrong'))

                          <br>

                            <div class="alert">
                          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                          <strong>Opps !</strong> {{Session::get('wrong')}}
                          </div>
                          <br>
                            @endif
                            @if(Session::has('success'))


                            <br>

                            <div class="success">
                          <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                          <strong>Congrats !</strong> {{Session::get('success')}}
                          </div>
                            <br>
                            @endif

                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                          
           
                            <th> Ngày đặt hàng </th>
                            <th> Mã đơn hàng</th>
                            <th> Tên khách hàng </th>
                            <th> Số điện thoại khách hàng</th>
                        
                            <th> Địa chỉ giao hàng </th>
              
                  
                           
                            <th> Hành động </th>
                          </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                          <tr>
                           
                            <td>
                              <span class="ps-2">{{ $order->purchase_date }}</span>
                            </td>
                            <td> {{ $order->invoice_no }} </td>
                            <td>


                            @php

                              $user=DB::table('users')->where('id',$order->user_id)->first();

                            @endphp


                            {{  $user->name }}



                            </td>


                            <td>  {{  $user->phone }}</td>
                            <td> {{ $order->shipping_address }} </td>
                     


                            <td>

                            <a href="{{ asset('/invoice/details/'.$order->invoice_no) }}" class="badge badge-outline-primary">Chi tiết</a>
                            <a href="{{ asset('/invoice/complete/'.$order->invoice_no) }}" class="badge badge-outline-success" style="margin-left:10px;">Hoàn thành đơn hàng</a>
                          </td>
                          </tr>

                        @endforeach
                       
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>





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