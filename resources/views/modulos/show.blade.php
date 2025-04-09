<x-layouts.app :title="__('lecciones del modulo')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    Inicio
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('asignaturas.index') }}"
                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Asignaturas</a>
                </div>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('asignaturas.show', $asignatura) }}"
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $asignatura->name }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('modulos.index', [$asignatura, $modulo]) }}"
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Módulos</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Detalles de Módulo
                        {{ $modulo->name }}</span>
                </div>
            </li>


        </ol>
    </nav>
    <h2 class="uppercase font-bold text-xl text-gray-600 text-wrap p-1 my-2 text-center">
        Módulo de {{ $asignatura->name }}
    </h2>
    <h2
        class="uppercase text-center font-bold m-auto text-xl text-gray-500 text-wrap justify-center items-center p-1 my-0">
        {{ $modulo->name }}
    </h2>
    <h2
        class="uppercase text-center font-bold m-auto text-[18px] text-gray-600 text-wrap justify-center items-center p-1 my-4">
        Descripción del módulo
    </h2>

    <p class="p-3 border rounded text-justify">{{ $modulo->description }}</p>

    <h2
        class="uppercase text-center font-bold m-auto text-2xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        Lecciones
    </h2>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('modulos.create', [$asignatura]) }}">Crear Lección</a>
            </div>
        @endrole --}}

        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @foreach ($lessons as $key => $lesson)
                <div class="px-6 py-1 bg-gray-300 border border-gray-400 rounded my-0">
                    <h1 class="p-1 text-center font-bold m-auto text-[12px] uppercase text-gray-700">
                        {{ 'Leccion  ' . $key + 1 }}
                    </h1>
                    <h2
                        class="my-0 uppercase text-center font-bold m-auto text-[12px] text-gray-700 text-wrap justify-center items-center p-4">
                        {{ $lesson->name }}
                    </h2>
                    <p>{{ $lesson->description }}</p>

                    {{-- <div class="flex justify-between">
                        @role('teacher')
                            <a href="{{ route('modulos.show', [$asignatura, $modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura, $modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar
                            </a>
                        @endrole

                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura, $modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Lecciones
                            </a>
                        @endrole
                    </div> --}}

                </div>
            @endforeach
        </div>
        @if ($lessons->count() > 0)
            {{ $lessons->links() }}
        @endif
    </div>
</x-layouts.app>
