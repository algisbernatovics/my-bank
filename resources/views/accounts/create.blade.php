<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div
            class="max-w-7xl mx-auto sm:flex-1 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg animate-fade-in">
            <div class="pt-8 inline-block">
                <form method="POST" action="{{ route('accounts.create') }}">@csrf
                    <div class="pt-8">
                        <label for="currency">Choose Your Currency:</label><br>
                        <select class="sm:items-center sm:rounded-lg" id="cars" name="currency">
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                            <option value="AUD">AUD</option>
                            <option value="BGN">BGN</option>
                            <option value="BRL">BRL</option>
                            <option value="CAD">CAD</option>
                            <option value="CHF">CHF</option>
                            <option value="CNY">CNY</option>
                            <option value="CZK">CZK</option>
                            <option value="DKK">DKK</option>
                            <option value="HKD">HKD</option>
                            <option value="HUF">HUF</option>
                            <option value="IDR">IDR</option>
                            <option value="ILS">ILS</option>
                        </select>
                    </div>
                    <div class="pt-8">
                        <label for="type">Choose Account Type:</label><br>
                        <select class="sm:items-center sm:rounded-lg" id="type" name="type">
                            <option value="Standard">Standard</option>
                            <option value="Investment">Investment</option>
                        </select>
                    </div>
                    <div class="pt-8">
                        <x-button class="my-8" type="=submit">Create New Account</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
