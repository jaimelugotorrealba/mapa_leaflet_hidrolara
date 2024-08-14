<x-app-layout>
    <section class="flex flex-col justify-center items-center">
        <h1 class="block py-4 mt-5 mb-5 text-2xl font-semibold">{{ __('Agregar ubicación') }}</h1>
        <form method="POST" action="{{ ($operability) ? route('map.update',['operability' => $operability->id]) : route('map.store') }}"
            class="py-3 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-4/5  md:w-4/5">  
            @csrf
            <x-validation-errors />
            @if (session('successful-message'))
                <div class="bg-green-700">
                    <p class="text-white text-lg font-semibold p-1 text-center">{{ session('successful-message') }}</p>
                </div>
            @endif
            @livewire('ubication-create', ['operability' => $operability])


            {{-- Boton de guardar y volver --}}
            <div class="flex justify-center">
                <button type="submit"
                    class="text-center m-6 mb-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center w-full md:w-1/2 lg:w-48">{{ __('Guardar') }}</button>

                    <a href="{{ route('dashboard') }}" class="text-center m-6 mb-0 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center w-full md:w-1/2 lg:w-48">{{ __('Volver') }}</a>
            </div>

        
        </form>


    </section>
</x-app-layout>
