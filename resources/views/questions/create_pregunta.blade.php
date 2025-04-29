<x-layouts.app :title="__('Crear pregunta de exámen')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            @include('nav.asignatura')
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('asignaturas.index', $asignatura) }}"
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Listado de
                        Exámenes</a>
                </div>
            </li>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Crear
                        Pregunta</span>
                </div>
            </li>

        </ol>
    </nav>
    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        @livewire('base.create-question', compact('asignatura', 'examen'))
    </div>
    </div>
    </x-app-layout>
