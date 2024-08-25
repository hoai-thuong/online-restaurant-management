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
            height: 600px; /* Fixed height for content */
            padding: 10px;
            background: white; /* Background color for the form container */
            border-radius: 8px; /* Optional: for rounded corners */
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow: hidden; /* Hide any overflow content */
        }
        .content form {
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

                <x-jet-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Mật khẩu') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-jet-checkbox id="Ghi nhớ" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">{{ __('Ghi nhớ') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Quên mật khẩu ?') }}
                            </a>
                        @endif

                        <x-jet-button class="ml-4">
                            {{ __('Đăng nhập') }}
                        </x-jet-button>
                    </div><br>
                    <div style="text-align:center">
                        Hoặc, 
                        <u><a href="/register">Đăng ký ngay</a></u>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</body>
</html>
