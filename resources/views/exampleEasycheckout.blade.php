<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Nhà hàng HT</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body class="bg-light">
<div class="container">
    <div class="py-5 text-center">
        <h2>Nhà hàng HT</h2>
    </div>

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Tổng tiền</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tổng (VNĐ)</span>
                    <strong name = "total"> {{  number_format($total, 0, ',', '.')  }}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Địa chỉ giao hàng</h4>
            <form id="paymentForm" method="POST" action="{{ url('/vnpay-payment') }}">
                @csrf
                <div class="mb-3">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Đường, quận,..."
                           value="334 Nguyễn Trãi" required>
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address2">Địa chỉ 2 <span class="text-muted">(Không bắt buộc)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Căn hộ">
                </div>

                <div class="row">
                    <div class="col-md-5 mb-3">
                        <label for="country">Thành phố</label>
                        <select class="custom-select d-block w-100" id="country" required>
                            <option value="">Chọn...</option>
                            <option value="Bangladesh">Hà Nội</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="state">Quốc gia</label>
                        <select class="custom-select d-block w-100" id="state" required>
                            <option value="">Chọn...</option>
                            <option value="Dhaka">Viêt Nam</option>
                        </select>
                        <div class="invalid-feedback">
                            Please provide a valid state.
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>
                <hr class="mb-4">

                <p id="add" style="display:none;"></p>
                <hr class="mb-4">
                <!-- <input type="hidden" name="amount" value="{{ $total }}"> -->
                <input type="hidden" id="amount" name="amount" placeholder="" value = "{{$total}}" required>

                <!-- Nút thanh toán -->
                <button type="submit" name = "redirect" class="btn btn-primary btn-lg btn-block" id="sslczPayBtn">Thanh toán VNPAY</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>
</html>
