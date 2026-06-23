<x-guest-layout>
    <div style="text-align: center; margin-bottom: 24px;">
        <h2 style="font-size: 22px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">Create Account</h2>
        <p style="font-size: 14px; color: var(--ds-text-tertiary); margin: 0;">Fill in your details to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="saas-form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <button type="submit" class="saas-btn saas-btn-primary" style="width: 100%; justify-content: center; padding: 10px 20px; font-size: 14px;">
            <span class="btn-text">{{ __('Register') }}</span>
        </button>

        <div style="text-align: center; margin-top: 16px;">
            <span style="font-size: 13px; color: var(--ds-text-tertiary);">Already have an account?</span>
            <a href="{{ route('login') }}" style="font-size: 13px; color: var(--ds-primary); text-decoration: none; font-weight: 600; margin-left: 4px;">Sign in</a>
        </div>
    </form>
</x-guest-layout>
