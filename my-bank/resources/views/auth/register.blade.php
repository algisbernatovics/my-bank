<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
            </a>
        </x-slot>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{old('name')}}" required
                         autofocus/>
            </div>

            @error('name')
            <div class="mb-2" style="color: red;">
                {{ $message }}
            </div>
            @enderror

            <!-- Surname -->
            <div>
                <x-label for="surname" :value="__('Surname')"/>

                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" value="{{old('surname')}}"
                         required autofocus/>
            </div>

            @error('surname')
            <div class="mb-2" style="color: red;">
                {{ $message }}
            </div>
            @enderror

            <!-- Personal Code -->
            <div>
                <x-label for="personal_code" :value="__('Personal Code')"/>

                <x-input id="personal_code" class="block mt-1 w-full" type="text" name="personal_code"
                         value="{{old('personal_code')}}" required autofocus/>
            </div>

            @error('personal_code')
            <div class="mb-2" style="color: red;">
                {{ $message }}
            </div>
            @enderror

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{old('email')}}"
                         required/>
            </div>

            @error('email')
            <div class="mb-2" style="color: red;">
                {{ $message }}
            </div>
            @enderror

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>

            @error('password')
            <div class="mb-2" style="color: red;">
                {{ $message }}
            </div>
            @enderror
            
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>

            </div>
            <!-- Validation Errors -->

        </form>
    </x-auth-card>
</x-guest-layout>
