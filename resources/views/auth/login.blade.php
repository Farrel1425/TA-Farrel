<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="mx-auto mb-6">
            <img src="{{ asset('images/logo-smpk2-harapan.png') }}"
                 alt="Logo SMPK 2 Harapan"
                 class="h-20 w-auto object-contain mx-auto drop-shadow-lg">
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Sistem Perpustakaan</h1>
        <h2 class="text-xl font-semibold text-blue-600 mb-3">SMPK 2 Harapan</h2>
        <p class="text-gray-600">Silakan masuk ke akun Anda</p>
    </div>

    <!-- Login Form Card -->
    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Username Field -->
            <div class="space-y-2">
                <x-input-label for="login" :value="'Username'" class="text-sm font-semibold text-gray-700" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <x-text-input id="login"
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white text-gray-900 placeholder-gray-500"
                        type="text"
                        name="login"
                        :value="old('login')"
                        placeholder="Masukkan username Anda"
                        required
                        autofocus />
                </div>
                <x-input-error :messages="$errors->get('login')" class="mt-2" />
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-gray-700" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <x-text-input id="password"
                        class="block w-full pl-10 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white text-gray-900 placeholder-gray-500"
                        type="password"
                        name="password"
                        placeholder="Masukkan password Anda"
                        required
                        autocomplete="current-password" />

                    <!-- Toggle Password Visibility -->
                    <button type="button"
                        class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 hover:text-gray-600 transition-colors duration-200 focus:outline-none focus:text-blue-600"
                        onclick="togglePasswordVisibility()"
                        id="togglePassword">
                        <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                {{-- <label for="remember_me" class="flex items-center group cursor-pointer">
                    <input id="remember_me"
                        type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-2 transition-all duration-200"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors duration-200">{{ __('Remember me') }}</span> --}}
                {{-- </label> --}}

                {{-- @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
            </div>

            <!-- Login Button -->
           <div class="pt-4">
                <x-primary-button class="w-full bg-gradient-to-r from-blue-600 to-white hover:from-blue-700 hover:to-gray-50 text-white hover:text-black font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-300 focus:outline-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('Log in') }}
                </x-primary-button>

            </div>
        </form>
    </div>

    <!-- Footer -->
    <div class="text-center mt-8">
        {{-- <p class="text-sm text-gray-500">
            Aplikasi ini dilindungi oleh keamanan tingkat enterprise
        </p> --}}
    </div>

    <!-- JavaScript for password toggle -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</x-guest-layout>
