<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MidwayCafe</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/short.jpg') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: url('{{ asset('assets/images/background.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        .content {
            position: relative;
            width: 100%;
            max-width: 500px; /* Adjust as needed */
            height: 400px; /* Fixed height for content */
            padding: 20px;
            background: white; /* Background color for the form container */
            border-radius: 8px; /* Optional: for rounded corners */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden; /* Hide any overflow content */
        }
        .content .form-wrapper {
            display: flex;
            flex-direction: column;
            gap: 16px; /* Space between form elements */
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <img width="100px" src="{{ asset('assets/images/logo.png') }}">
                </x-slot>

                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Quên mật khẩu? Không vấn đề gì. Chỉ cần cho chúng tôi biết địa chỉ email của bạn và chúng tôi sẽ gửi cho bạn một liên kết đặt lại mật khẩu cho phép bạn chọn mật khẩu mới.') }}
                </div>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.email') }}" class="form-wrapper">
                    @csrf

                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('EMAIL LIÊN KẾT ĐẶT LẠI MẬT KHẨU') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</body>
</html>
