<x-layouts.app :title="__('lecciones del modulo')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            @include('nav.asignatura')
            @include('nav.modulos')
            @include('nav.leccion')
        </ol>
    </nav>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2 class="uppercase font-bold text-xl text-gray-600 text-wrap p-1 my-0 text-center">
            {{ $asignatura->name }}
        </h2>
        <h2 class="uppercase font-bold text-xl text-gray-600 text-wrap p-0 my-0 text-center">
            Lecciones del Módulo
        </h2>
        <h2 class="uppercase font-bold text-xl text-gray-600 text-wrap p-1 my-2 text-center">
            {{ $modulo->name }}
        </h2>


        @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('lessons.create', [$asignatura, $modulo]) }}">Crear Lección</a>
            </div>
        @endrole

        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @foreach ($lessons as $key => $lesson)
                <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">
                    <h1 class="text-center font-bold m-auto text-[16px] uppercase text-gray-700">{{ 'lesson  ' . $key + 1 }}
                    </h1>
                    <h2
                        class="uppercase text-center font-bold m-auto text-[13px] text-gray-700 text-wrap justify-center items-center mt-4 mb-6">
                        {{ $lesson->name }}
                    </h2>
                    <p class="p-3 border rounded text-justify text-[12px] bg-white my-2">{{$lesson->description}}</p>

                    <div class="flex justify-between">
                        @role('teacher')
                            <a href="{{ route('lessons.show', [$asignatura, $modulo, $lesson]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver detalles de lección
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('lessons.edit', [$asignatura, $modulo, $lesson]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar Lección
                            </a>
                        @endrole

                        @role('teacher')
                             <a href="{{ route('base.preguntas', [$modulo,$lesson]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver y Crear Preguntas de lección para Exámen
                            </a> -
                        @endrole
                    </div>

                </div>
            @endforeach
        </div>
        @if ($lessons->count() > 0)
            {{ $lessons->links() }}
        @endif
    </div>
</x-layouts.app>
