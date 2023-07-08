<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto lg:px-8 flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 1000px;">

                <div
                    class="pt-4 max-w-7xl mx-auto sm:flex-1 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg animate-fade-in">
                    <br><br>
                    <img class="mx-auto mb-8"
                         src="https://leverageedublog.s3.ap-south-1.amazonaws.com/blog/wp-content/uploads/2019/10/23165643/Bank-Manager.jpg"
                         alt="MyBank Logo" width="400">
                    <div class="pt-4">
                        <h1 class="text-4xl font-bold mb-4 font-semibold">Welcome to MyBank Internet Banking</h1>
                        <p class="text-lg">Stay connected with your finances anytime, anywhere.</p>
                    </div>

                    <div class="pt-4">
                        <h2 class="text-2xl font-bold mb-4">Latest News</h2>
                        <p class="text-base">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>

                    <div class="mt-8">
                        <p class="text-sm text-gray-600">Disclaimer: This is a fictitious internet banking application.
                            All news and information displayed on this page are for demonstration purposes only and
                            should not be taken seriously. <span class="italic">Stay safe and enjoy exploring!</span>
                        </p>
                    </div>
                    <br>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>

