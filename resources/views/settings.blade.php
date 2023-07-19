<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <p>Two Factor Authentication Settings.</p><br>

                    @if(!isset(Auth::user()['two_factor_confirmed_at']))

                        <form action="/user/two-factor-authentication" method="POST">@csrf
                            <x-button>Generate Qr And Recovery Codes</x-button>
                        </form><br>

                        <div class="mb-4 font-medium text-sm">
                            To complete 2FA Setup follow these steps:<br><br>
                            1.Press 'Generate Qr And Recovery Codes'<br>
                            2.First save your 2FA recovery code to safe place.<br>
                            3.Scan QR code to your authenticator.<br>
                            4.Input Code from your authenticator in the confirmation field below.<br>
                            5.Press Confirm button.<br>
                        </div>

                        @if (session('status') == 'two-factor-authentication-enabled')
                            @foreach(Auth::user()->recoveryCodes() as $code)
                                {{$code}}
                                <br>
                            @endforeach
                            <br>
                            {!! Auth::user()->twoFactorQrCodeSvg() !!}<br>
                            <div class="mb-4 font-medium text-sm">Please dont forget to save your recovery codes.</div>
                            <form method="POST" action="/user/confirmed-two-factor-authentication">@csrf
                                <!-- Authenticator Code Confirm -->
                                <div>
                                    <x-label for="code" :value="__('Authenticator Code')"/>
                                    <x-input id="code" class="block mt-1 w-full"
                                             type="text"
                                             name="code"
                                             required autocomplete="false"/>
                                </div>
                                <div class="flex justify-end mt-4">
                                    <x-button>
                                        {{ __('Confirm') }}
                                    </x-button>
                                </div>
                            </form>
                        @endif
                    @endif
                    @if(isset(Auth::user()['two_factor_confirmed_at']))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            Two factor authentication confirmed and enabled
                            successfully. {{Auth::user()['two_factor_confirmed_at']}}
                        </div>
                        <x-button onclick="ShowQRCode()">Show QR Code</x-button>
                        <script>
                            function ShowQRCode() {
                                var qrCode = document.getElementById("QRCode");

                                if (qrCode.style.display === "none") {
                                    qrCode.style.display = "block";
                                } else {
                                    qrCode.style.display = "none";
                                }
                            }
                        </script>
                        <div style="display:none" class='pt-8' id="QRCode">
                            {!! Auth::user()->twoFactorQrCodeSvg() !!}<br>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
