<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="" style="max-width: 1000px;">
                <div class="overflow-x-auto">

                    @if(isset($investmentAccounts))

                        <table
                            class="w-3/4 mx-auto  text-sm text-left text-gray-500 dark:text-gray-400 animate-fade-in">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            &nbsp;<p class="font-semibold">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Account
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Balance
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($investmentAccounts as $account)

                                <tr class="bg-white border">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                        <div class="map">
                                            <a href="investments/{{$account->acc_number}}"
                                               class="animate-fade-in">
                                                {{$account->acc_number}}
                                            </a>
                                        </div>
                                    </th>

                                    <td class="px-6 py-4">
                                        {{$account->balance()}}{{$account->currency}}
                                    </td>
                                    <td class="px-6 py-4">

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(!isset($investmentAccounts))
        <div class="py-12">
            <div class="container mx-auto py-8 flex justify-center">
                <p class="">
                    You do not have an investment account.
                </p>
            </div>
        </div>
    @endif

</x-app-layout>
