<x-layouts.app :title="__('Crear Asignatura')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
          <li class="inline-flex items-center">
            <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
              <svg class="w-3 h-3 me-2.5 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
              </svg>
             Inicio
            </a>
          </li>
          <li>
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <a href="{{route('asignaturas.index')}}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Asignaturas</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Creación de Asignatura</span>
            </div>
          </li>
        </ol>
      </nav>
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
                    <textarea id="description" type="textarea" name="description" rows="6"
                        class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500 bg-white"></textarea>
                </div>

                <button type="submit"
                    class="w-full p-2 mb-6 text-white bg-blue-500 rounded-lg hover:bg-white hover:text-black hover:border hover:border-gray-300 capitalize">
                    {{ __('asignatura create') }}
                </button>

            </div>
         </div>
    </div>
    <div class="flex gap-4 mx-2">
            <button type="submit"
                class="p-2 mb-6 text-white bg-blue-500 rounded-lg hover:bg-white hover:text-black hover:border hover:border-gray-300 capitalize">
                {{ __('asignatura create') }}
            </button>

            <a type="button" href="{{ route('asignaturas.index') }}"
                class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm p-2 text-center mb-6 capitalize">
                {{ __('cancel') }}

            </a>
        </div>
</form>

</x-layouts.app>
