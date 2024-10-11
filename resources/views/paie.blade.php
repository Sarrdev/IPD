<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paiement') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="#" class="space-y-4">
                        @csrf

                        <!-- Numéro de téléphone -->
                        <div>
                            <x-input-label for="phone_number" :value="__('Numéro de téléphone')" />
                            <x-text-input id="phone_number" name="phone_number" type="text" placeholder="+221 77 000 00 00" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Opérateur de paiement -->
                        <div>
                            <x-input-label for="operator" :value="__('Opérateur de paiement')" />
                            <div class="flex items-center">
                                <img id="wave_logo" src="{{ asset('images/wave.png') }}" alt="Wave" class="h-6 w-6 mr-2">
                                <img id="orange_money_logo" src="{{ asset('images/om.png') }}" alt="Orange Money" class="h-6 w-6 mr-2">
                                <select id="operator" name="operator" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" onchange="toggleLogos()" required>
                                    <option value="">-- Sélectionnez l'opérateur --</option>
                                    <option value="wave">Wave</option>
                                    <option value="orange_money">Orange Money</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('operator')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Procéder au paiement') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleLogos() {
            const operator = document.getElementById('operator').value;
            const waveLogo = document.getElementById('wave_logo');
            const orangeMoneyLogo = document.getElementById('orange_money_logo');

            waveLogo.style.display = 'none';
            orangeMoneyLogo.style.display = 'none';

            if (operator === 'wave') {
                waveLogo.style.display = 'block';
            } else if (operator === 'orange_money') {
                orangeMoneyLogo.style.display = 'block';
            }else{
                waveLogo.style.display = 'block';
                orangeMoneyLogo.style.display = 'block';
            }
        }
    </script>
       @include('layouts.footer')
</x-app-layout>
