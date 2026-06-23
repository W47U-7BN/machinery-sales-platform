<section>
    <header style="margin-bottom: 24px;">
        <h2 style="font-size: 17px; font-weight: 700; color: var(--ds-text-primary); margin: 0;">{{ __('Update Password') }}</h2>
        <p style="font-size: 13px; color: var(--ds-text-tertiary); margin: 4px 0 0;">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="saas-form-group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full" autocomplete="current-password" placeholder="Enter current password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full" autocomplete="new-password" placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="saas-form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full" autocomplete="new-password" placeholder="Confirm your password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div style="display: flex; align-items: center; gap: 12px;">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2000)" style="font-size: 13px; color: var(--ds-success);">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
