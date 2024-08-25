<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<div class="container">
    <div class="row">
        <div class="span4">
            <img src="http://webivorous.com/wp-content/uploads/2020/06/brand-logo-webivorous.png" class="img-rounded logo">
            <address>
                <strong>Nhà hàng của chúng tôi</strong><br>
                Địa chỉ: 123 Đường ABC<br>
                Thành phố XYZ, Việt Nam
            </address>
        </div>
        <div class="span4 well">
            <table class="invoice-head">
                <tbody>
                    <tr>
                        <td class="pull-right"><strong>Khách hàng:</strong></td>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Số điện thoại:</strong></td>
                        <td>{{ $phone }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Email:</strong></td>
                        <td>{{ $email }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Ngày đặt:</strong></td>
                        <td>{{ $date }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Thời gian:</strong></td>
                        <td>{{ $time }}</td>
                    </tr>
                    <tr>
                        <td class="pull-right"><strong>Số lượng khách:</strong></td>
                        <td>{{ $no_guest }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span8">
            <h2>Xác nhận đặt chỗ</h2>
        </div>
    </div>

    <div class="row">
        <div class="span8 well invoice-thank">
            <h3 style="text-align:center;">Cảm ơn bạn đã đặt chỗ tại nhà hàng của chúng tôi!</h3>
        </div>
    </div>
    <div class="row">
        <div class="span3">
            <strong>Điện thoại:</strong> (0123) 456-789
        </div>
        <div class="span3">
            <strong>Email:</strong> <a href="mailto:info@restaurant.com">info@restaurant.com</a>
        </div>
    </div>
</div>

<style>
.invoice-head td {
  padding: 0 8px;
}
.container {
  padding-top: 30px;
}
.invoice-body {
  background-color: transparent;
}
.invoice-thank {
  margin-top: 60px;
  padding: 5px;
}
address {
  margin-top: 15px;
}
</style>
