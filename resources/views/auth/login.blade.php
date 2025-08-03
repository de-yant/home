<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full max-w-md space-y-6 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
        <div class="flex justify-center items-center">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('pengawas.dashboard') }}">
                    Dashboard
                </a>
            @endauth
            <img src="{{ asset('asset/image/logo.png') }}" alt="Logo" class="h-16 w-auto">
            </a>
        </div>
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Welcome Back 👋</h2>
            <p class="text-sm text-gray-500 dark:text-gray-300">Sign in to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="mt-1 block w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-600 hover:underline dark:text-indigo-400"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div>
                <x-primary-button class="w-full justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        {{-- kembali ke halaman welcome --}}
        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-sm text-indigo-600 hover:underline dark:text-indigo-400">
                {{ __('Back to Home') }}
            </a>
        </div>
    </div>
</x-guest-layout>
