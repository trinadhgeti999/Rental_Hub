@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile_delete.css') }}">
@endpush

<section class="space-y-6">
    <header>
        <h2 class="dashboard-title">
            {{ __('Delete Account') }}
        </h2>

        <p class="dashboard-description">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn-danger" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Delete Account') }}
    </button>

    <div x-data="{}" x-show="openModal === 'confirm-user-deletion'" x-on:close="openModal = null" class="modal">
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('delete')

            <h2 class="modal-title">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" />

                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" class="btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn-danger ms-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>
