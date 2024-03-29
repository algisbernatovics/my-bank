<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(isset(Auth::user()['two_factor_confirmed_at']))
        @if(isset($accounts))

            <form method="POST" action="{{ route('transfer.process') }}">@csrf
                <div class="py-12">
                    <div
                        class="max-w-7xl mx-auto sm:flex-1 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg animate-fade-in">
                        <div class="pt-8 inline-block">
                            <label class="inline-block" for="currency">Choose Account From:</label><br>
                            <select id="sourceAccount" name="sourceAccount" class="sm:items-center sm:rounded-lg">

                                @foreach($accounts as $account)
                                    <option
                                        value="{{$account->acc_number}}" {{ old('sourceAccount') == $account->acc_number ? 'selected' : '' }}>
                                        {{$account->acc_number}}
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        Balance:{{$account->balance()}}
                                        {{$account['currency']}}
                                    </option>
                                @endforeach

                            </select>
                            <br>

                            <div class="pt-8">
                                <label for="name">Beneficiary account:</label><br>
                                <input class="sm:items-center sm:rounded-lg" id="targetAccount" type="text" class=""
                                       name="targetAccount"
                                       value="{{old('targetAccount')}}"
                                       required autofocus/>
                            </div>

                            @error('targetAccount')
                            <div class="mb-2" style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="pt-8">
                                <label class="inline-flex" for="name">Beneficiary Name Surname:</label><br>
                                <div class="">
                                    <input class="sm:items-center sm:rounded-lg"
                                           id="nameSurname" type="text"
                                           class="" name="nameSurname"
                                           value="{{old('nameSurname')}}"
                                           required autofocus/>
                                </div>
                            </div>

                            @error('nameSurname')
                            <div class="mb-2" style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="pt-8">
                                <label class="inline-flex" for="name">Beneficiary Personal Code:</label><br>
                                <div class="">
                                    <input class="sm:items-center sm:rounded-lg"
                                           id="personalCode" type="text"
                                           class="" name="personalCode"
                                           value="{{ old('personalCode') }}"
                                           required autofocus/>
                                </div>
                            </div>

                            @error('personalCode')
                            <div class="mb-2" style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="pt-8">
                                <label class="inline-flex" for="name">Amount of funds:</label><br>
                                <div class="">
                                    <input class="sm:items-center sm:rounded-lg"
                                           id="amountOfFunds" type="text" class="" name="amountOfFunds"
                                           value="{{old('amountOfFunds')}}"
                                           required autofocus/>
                                </div>
                            </div>

                            @error('amountOfFunds')
                            <div class="mb-2" style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="pt-8">
                                <label class="inline-flex" for="2FaCode">2FA Code:</label><br>
                                <div class="">
                                    <input class="sm:items-center sm:rounded-lg"
                                           id="2FaCode" type="number" class="" name="2FaCode"
                                           :value="old('')"
                                           required autofocus/>
                                </div>
                            </div>

                            @error('2FaCode')
                            <div class="mb-2" style="color: red;">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="pt-8">
                                <br>
                                <x-button>Transfer</x-button>
                                <br>
                            </div>
                            <div class="mt-8"></div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    @endif

    @if(!isset(Auth::user()['two_factor_confirmed_at']))
        <br> <br>
        <div class="py-12">
            <div class="container mx-auto py-8 flex justify-center">
                <p class="">
                    Please enable two factor authentication in your settings first.
                </p>
            </div>
        </div>
    @endif

    @if(!isset($accounts))
        <br> <br>
        <div class="py-12">
            <div class="container mx-auto py-8 flex justify-center">
                <p class="">
                    You currently do not have an accounts.
                </p>
            </div>
        </div>
    @endif

</x-app-layout>

