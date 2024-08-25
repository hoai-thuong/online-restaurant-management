<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <title>Successful Reservation</title>
</head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
      .btn-warning {
      display: inline-block;
      background-color: #FFA500;
      color: white;
      padding: 10px 20px;
      border-radius: 25px;
      text-decoration: none;
      font-size: 18px;
      font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
      font-weight: bold;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    .btn-warning:hover {
      background-color: #FF8C00;
    }

    .btn-warning i {
      margin-right: 8px;
    }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>Chúng tôi đã nhận thành công yêu cầu của bạn;<br/> Chúng tôi sẽ liên lạc lại trong thời gian ngắn</p>
        <a href="{{ url('/menu') }}" class="btn-warning">
        <i class="fa fa-angle-left"></i> Tiếp tục đặt hàng
      </a>
      </div>
    </body>
</html>