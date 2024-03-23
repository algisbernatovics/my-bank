<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 flex justify-center animate-fade-in">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">

                    @if(isset($transactions))

                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                            <tr>
                                <th class="py-2 px-4 border-b border-gray-200 font-semibold text-sm text-gray-700">
                                    Name
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 font-semibold text-sm text-gray-700">
                                    Type
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 font-semibold text-sm text-gray-700">
                                    Account
                                </th>

                                <th class="py-2 px-4 border-b border-gray-200 font-semibold text-sm text-gray-700">
                                    Funds
                                </th>
                                <th class="py-2 px-4 border-b border-gray-200 font-semibold text-sm text-gray-700">
                                    Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($transactions as $transaction)

                                @if($transaction->from === $myAccount->acc_number and $transaction->type === 'Investment Buy')
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600"></td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$transaction->type}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$myAccount->acc_number}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">
                                            -{{$transaction->transfer_amount / 100}}{{$myAccount->currency}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$transaction->created_at}}</td>
                                    </tr>
                                @endif

                                @if($transaction->to === $myAccount->acc_number and $transaction->type === 'Investment Sell')
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600"></td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->type}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$myAccount->acc_number}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">
                                            +{{$transaction['converted_amount'] / 100}}{{$myAccount->currency}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->created_at}}</td>
                                    </tr>
                                @endif

                                @if($transaction->to === $myAccount->acc_number and $transaction->type === 'ATM Deposit')
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600"></td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->type}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->to}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">
                                            +{{$transaction->converted_amount / 100}}{{$myAccount->currency}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->created_at}}</td>
                                    </tr>
                                @endif

                                @if($transaction->from === $myAccount->acc_number and $transaction->type === 'Transfer')
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">
                                            {{$transaction->senderAcc->user->name}} {{$transaction->senderAcc->user->surname}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$transaction->type}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$transaction->to}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">
                                            -{{$transaction->transfer_amount / 100}}{{$myAccount->currency}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-red-600">{{$transaction->created_at}}</td>
                                    </tr>
                                @endif

                                @if($transaction->to === $myAccount->acc_number and $transaction->type === 'Transfer')
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">
                                            {{$transaction->receiverAcc->user->name}} {{$transaction->receiverAcc->user->surname}}
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->type}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->from}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">
                                            +{{$transaction->converted_amount / 100}}{{$myAccount->currency}}</td>
                                        <td class="py-2 px-4 border-b border-gray-200 text-green-600">{{$transaction->created_at}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    @if(!isset($transactions))
        <div class="container mx-auto py-8 flex justify-center">
            <p class="">
                This account has an empty transaction history.
            </p>
        </div>
    @endif

</x-app-layout>




