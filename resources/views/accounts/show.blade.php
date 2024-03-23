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

                    @if($accounts && !$accounts->isEmpty())
                        <table class="w-3/4 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 animate-fade-in">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Account</th>
                                <th scope="col" class="px-6 py-3">Type</th>
                                <th scope="col" class="px-6 py-3">Balance</th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)
                                <tr class="bg-white border">
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap dark:text-white">
                                        <div class="map">
                                            <a href="account/transactions/{{$account->acc_number}}" class="animate-fade-in">
                                                {{$account->acc_number}}
                                            </a>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">{{$account->type}}</td>
                                    <td class="px-6 py-4">{{round($account->balance() / 100, 2)}}{{$account->currency}}</td>
                                    <td class="px-6 py-4">
                                        @if($account->balance() == 0)
                                            <form method="POST" action="/accounts/delete">@csrf
                                                <input type="hidden" id="acc_number" name="acc_number" value="{{$account->acc_number}}">
                                                <div class="">
                                                    <x-button>Delete Account</x-button>
                                                </div>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="container mx-auto py-8 flex justify-center">
                            <p class="">You currently do not have any accounts.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
