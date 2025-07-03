<x-guest-layout>
    <!-- Session Status -->
    <p class="text-center text-white text-xl mb-6">Sign in your account</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email"
                class="block mt-1 w-full dark:bg-black dark:focus:ring-[#ff7e1b] focus:ring-[#ff7e1b] dark:ring-0"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="hello@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="block mt-1 w-full dark:bg-black dark:focus:ring-[#ff7e1b] focus:ring-[#ff7e1b] dark:ring-0"
                type="password" name="password" required autocomplete="current-password" placeholder="********" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label class="flex items-center space-x-2">
                <input type="checkbox" id="remember_me" name="remember"
                    class="form-checkbox h-5 w-5 text-[#ff7e1b] bg-[#15100d] border-gray-400 rounded focus:ring-[#ff7e1b]" />
                <span class="text-gray-400">{{ __('Remember me') }}</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-[#ff7e1b] text-sm font-medium hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <button type="submit"
            class="w-full bg-[#ff7e1b] hover:bg-[#ff9a3c] text-white font-semibold py-2 rounded transition my-4">{{ __('Sign in') }}
        </button>
    </form>
    {{-- <p class="text-center text-gray-400 mt-4">
        Don't have an account?
        <a href="#" class="text-[#ff7e1b] hover:underline font-medium">Sign
            up</a>
    </p> --}}
</x-guest-layout>
