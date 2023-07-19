<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure 2FA area of the application. Please confirm your 2FA code before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/two-factor-challenge">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Authenticator Code')" />

                <x-input id="code" class="block mt-1 w-full"
                         type="text"
                         name="code"
                         required autocomplete="false" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
