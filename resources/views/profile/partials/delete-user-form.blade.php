<section>
    <header style="margin-bottom: 24px;">
        <h2 style="font-size: 17px; font-weight: 700; color: var(--ds-text-primary); margin: 0;">{{ __('Delete Account') }}</h2>
        <p style="font-size: 13px; color: var(--ds-text-tertiary); margin: 4px 0 0;">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 24px;">
            @csrf
            @method('delete')

            <div style="text-align: center; margin-bottom: 20px;">
                <div style="width: 56px; height: 56px; background: var(--ds-danger-light); border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 28px;">⚠</div>
                <h2 style="font-size: 18px; font-weight: 700; color: var(--ds-text-primary); margin: 0 0 4px;">{{ __('Are you sure you want to delete your account?') }}</h2>
                <p style="font-size: 13px; color: var(--ds-text-secondary); margin: 0;">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm.') }}</p>
            </div>

            <div class="saas-form-group">
                <x-input-label for="password" value="{{ __('Password') }}" />
                <x-text-input id="password" name="password" type="password" class="block w-full" placeholder="{{ __('Enter your password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
