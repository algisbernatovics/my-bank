<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-fade-in">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if(isset($cryptoCurrencys))

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Symbol
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Buy
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($cryptoCurrencys as $cryptoCurrency)

                                <tr class="bg-white border dark:bg-gray-800">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$cryptoCurrency['name']}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$cryptoCurrency['symbol']}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$cryptoCurrency['price']}}{{$investmentAccount->currency}}
                                    </td>
                                    <td class="px-6 py-4">

                                        <form class="inline-flex" method="POST"
                                              action="/investments/{{$investmentAccount->acc_number}}/buy/{{$cryptoCurrency['symbol']}}">@csrf
                                            <div class="">
                                                <input
                                                    class="custom-input-width sm:items-center sm:rounded-lg sm:w-32 mr-2"
                                                    id="amount" type="text" name="amount" placeholder="How much?"
                                                    :value="old('')" required autofocus/>
                                                <x-button type="submit">Buy</x-button>

                                                @if (session($cryptoCurrency['symbol'] . 'buy'))
                                                    <div class="mb-2" style="color: red;">
                                                        {{ session($cryptoCurrency['symbol'] . 'buy') }}
                                                    </div>
                                                @endif

                                            </div>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($cryptoCurrency['userInvestments'] > 0)
                                            <p class="font-semibold text-green-600">
                                                You
                                                Have:{{$cryptoCurrency['userInvestments']}}{{$cryptoCurrency['symbol']}}
                                            </p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($cryptoCurrency['userInvestments'] > 0)

                                            <form class="inline-flex" method="POST"
                                                  action="/investments/{{$investmentAccount->acc_number}}/sell/{{$cryptoCurrency['symbol']}}">@csrf
                                                <div class="">
                                                    <input
                                                        class="custom-input-width sm:items-center sm:rounded-lg mr-2"
                                                        id="amount" type="text" name="amount"
                                                        placeholder="How much?"
                                                        :value="old('')" required autofocus/>
                                                    <x-button type="submit">Sell</x-button>

                                                    @if (session($cryptoCurrency['symbol'] . 'sell'))
                                                        <div class="mb-2" style="color: red;">
                                                            {{ session($cryptoCurrency['symbol'] . 'sell') }}
                                                        </div>
                                                    @endif

                                                </div>
                                            </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
