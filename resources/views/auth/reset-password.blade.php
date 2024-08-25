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
            position: relative;
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
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            margin-bottom: 20px;
        }
        .alert.success {
            background-color: #4caf50;
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
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <x-guest-layout>
            <x-jet-authentication-card>
                <x-slot name="logo">
                    <img width="100px" src="{{ asset('assets/images/logo.png') }}">
                </x-slot>

                @if(Session::has('wrong'))
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Oops!</strong> {{ Session::get('wrong') }}
                </div>
                @endif

                @if(Session::has('success'))
                <div class="alert success">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Congrats!</strong> {{ Session::get('success') }}
                </div>
                @endif

                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('Reset Password') }}
                        </x-jet-button>
                    </div>
                </form>
            </x-jet-authentication-card>
        </x-guest-layout>
    </div>
</body>
</html>
