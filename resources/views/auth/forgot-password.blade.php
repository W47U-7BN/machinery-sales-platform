<x-guest-layout>
    <div style="text-align: center; margin-bottom: 24px;">
        <div style="width: 56px; height: 56px; background: var(--ds-primary-50); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">🔑</div>
        <h2 style="font-size: 22px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">Forgot Password?</h2>
        <p style="font-size: 14px; color: var(--ds-text-tertiary); margin: 0;">No worries, we'll send you reset instructions.</p>
    </div>

    <div class="mb-4" style="font-size: 13px; color: var(--ds-text-secondary);">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="saas-form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <button type="submit" class="saas-btn saas-btn-primary" style="width: 100%; justify-content: center; padding: 10px 20px; font-size: 14px;">
            <span class="btn-text">{{ __('Email Password Reset Link') }}</span>
        </button>

        <div style="text-align: center; margin-top: 16px;">
            <a href="{{ route('login') }}" style="font-size: 13px; color: var(--ds-primary); text-decoration: none; font-weight: 500;">
                <i class="bi bi-arrow-left"></i> Back to login
            </a>
        </div>
    </form>
</x-guest-layout>
