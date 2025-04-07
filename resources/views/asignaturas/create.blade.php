<x-layouts.app :title="__('Crear Asignatura')">
    <h2
    class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4 flex-1 bg-gray-100 rounded w-full uppercase py-2">

    {{ __('asignatura create') }}
</h2>
<form method="POST" action="{{ route('asignaturas.store') }}" class="w-full bg-red-50">
    @csrf
    <div class="px-10 items-center justify-center max-h-screen bg-gray-100 w-full">
        <div class="">
            <!-- left side -->
            <div class="">

                <div class="py-4 w-full">
                    <span class="mb-2 text-md">{{ __('Asignatura') }}</span>
                    <x-input id="name" type="text" name="name" :value="old('name', '')" required autofocus
                        autocomplete="name"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500"
                        name="name" id="name" />
                </div>
                <div class="py-4">
                    <span class="mb-2 text-md">{{ __('Descripción') }}</span>
                    <textarea id="description" type="" name="description"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 bg-white"></textarea>
                </div>

                <button type="submit"
                    class="w-full p-2 mb-6 text-white bg-blue-500 rounded-lg hover:bg-white hover:text-black hover:border hover:border-gray-300">
                    {{ __('Crear Asignatura') }}
                </button>

            </div>
         </div>
    </div>
</form>

</x-layouts.app>
