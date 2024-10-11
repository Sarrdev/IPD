<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Ajouter un Commentaire') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="p-6 bg-white border-b border-gray-200 animate-fade-in-up">
                    @foreach($preinscriptions as $preinscription)
                        <div class="preinscription mb-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ $preinscription->formation }}</h3>
                            <form action="{{ route('comment.store', ['id' => $preinscription->id]) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="comment" class="block text-sm font-medium text-gray-700">Commentaire</label>
                                    <textarea id="comment" name="comment" rows="4" class="mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 p-2" placeholder="Écrivez votre commentaire ici..." required></textarea>
                                    @error('comment')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition duration-150 ease-in-out">Ajouter Commentaire</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successAlert = document.querySelector('.alert-success');
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.transition = 'opacity 0.5s ease';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }, 3000);
        }
    });
</script>
