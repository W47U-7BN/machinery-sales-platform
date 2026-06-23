<x-guest-layout>
    <div style="text-align: center; margin-bottom: 24px;">
        <div style="width: 56px; height: 56px; background: var(--ds-primary-50); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 28px;">🔒</div>
        <h2 style="font-size: 22px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">Confirm Password</h2>
        <p style="font-size: 14px; color: var(--ds-text-tertiary); margin: 0;">This is a secure area of the application</p>
    </div>

    <div class="mb-4" style="font-size: 13px; color: var(--ds-text-secondary);">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div class="saas-form-group">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <button type="submit" class="saas-btn saas-btn-primary" style="width: 100%; justify-content: center; padding: 10px 20px; font-size: 14px;">
            <span class="btn-text">{{ __('Confirm') }}</span>
        </button>
    </form>
</x-guest-layout>
