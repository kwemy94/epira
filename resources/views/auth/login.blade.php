{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | HEALTHTECH AFRIQUE</title>
    <link rel="shortcut icon" href="{{ asset('favicon-32x32.png') }}" type="image/svg" />
    <link rel="apple-touch-icon" href="{{ asset('logo_chre22.png') }}">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('template_old/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template_old/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .login-container {
            display: flex;
            height: 100vh;
        }

        .login-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            padding: 40px;
        }

        .login-right {
            flex: 1.2;
            background: url("{{ asset('back.webp') }}") center center no-repeat;
            background-size: cover;
        }

        .logo {
            width: 400px;
            margin-bottom: 30px;
        }

        .login-card {
            width: 100%;
            max-width: 350px;
        }

        .btn-primary {
            background-color: #5e5ce6;
            border-color: #5e5ce6;
            border-radius: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .forgot-link {
            font-size: 0.9rem;
            color: #6c63ff;
        }

        .text-muted {
            font-size: 0.8rem;
            margin-top: 20px;
        }
    </style>
</head>

<body class="hold-transition">

    <div class="login-container">
        <!-- Partie gauche -->
        <div class="login-left">
            <img src="{{ asset('logo_entreprise.PNG') }}" alt="HEALTH TECH Logo" class="logo">

            <div class="login-card">
                <h4 class="text-center mb-3">Connexion</h4>
                <p class="text-center text-muted mb-4">Votre activité à vos côtés.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Identifiant" required
                            autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-lock"></i></div>
                        </div>
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Mot de passe oublié ? Réinitialiser
                        </a>
                    </div>
                </form>

                <p class="text-center text-muted">© {{ date('Y') }} HEALTHTECH AFRIQUE.</p>
            </div>
        </div>

        <!-- Partie droite (image docteur) -->
        <div class="login-right d-none d-md-block" {{-- style="background: url('{{ asset('back.webp') }}') center center no-repeat; background-size: cover;" --}}>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('template_old/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template_old/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template_old/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
