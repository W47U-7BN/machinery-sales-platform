<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div style="text-align: center; margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">Welcome Back</h2>
        <p style="font-size: 14px; color: var(--ds-text-tertiary); margin: 0;">Sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="saas-form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="saas-form-group">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <x-input-label for="password" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 12px; color: var(--ds-primary); text-decoration: none; font-weight: 500;">Forgot?</a>
                @endif
            </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="saas-form-group" style="display: flex; align-items: center; gap: 8px;">
            <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: var(--ds-primary); border-radius: 4px;">
            <label for="remember_me" style="font-size: 13px; color: var(--ds-text-secondary);">{{ __('Remember me') }}</label>
        </div>

        <button type="submit" class="saas-btn saas-btn-primary" style="width: 100%; justify-content: center; padding: 10px 20px; font-size: 14px;">
            <span class="btn-text">{{ __('Log in') }}</span>
        </button>

        @if (Route::has('register'))
            <div style="text-align: center; margin-top: 16px;">
                <span style="font-size: 13px; color: var(--ds-text-tertiary);">Don't have an account?</span>
                <a href="{{ route('register') }}" style="font-size: 13px; color: var(--ds-primary); text-decoration: none; font-weight: 600; margin-left: 4px;">Sign up</a>
            </div>
        @endif
    </form>
</x-guest-layout>
