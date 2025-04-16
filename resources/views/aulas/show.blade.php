<x-layouts.app :title="__('leccion del modulo')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            @include('nav.asignatura')
            @include('nav.modulos')
            @include('nav.leccion')

        </ol>
    </nav>
    <h2 class="uppercase text-center font-bold mx-auto text-[20px] text-gray-600 text-wrap items-center p-1 mt-2">
       {{ $asignatura->name }}
    </h2>
    <h2 class="uppercase text-center font-bold m-auto text-[18px] text-gray-600 text-wrap justify-center items-center p-1 my-0">
       {{ $modulo->name }}
    </h2>
    <h2 class="uppercase text-center font-bold m-auto text-[16px] text-gray-600 text-wrap justify-center items-center p-1 my-0">
        {{ $lesson->name }}
    </h2>

    <h2 class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 mt-2">
        Descripción de Lección
    </h2>

    <p class="p-3 border rounded text-justify">{{$lesson->description}}</p>

    <h2 class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        Preguntas
    </h2>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('modulos.create', [$asignatura]) }}">Crear Pregunta</a>
            </div>
        @endrole --}}

        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @foreach ($questions as $key => $question)
                <div class="px-6 py-1 bg-gray-300 border border-gray-400 rounded my-0">
                    <h1 class="p-1 text-center font-bold m-auto text-[12px] uppercase text-gray-700">{{ 'Pregunta  ' . $key + 1 }}
                    </h1>
                    <h2
                        class="my-0 uppercase text-center font-bold m-auto text-[12px] text-gray-700 text-wrap justify-center items-center p-4">
                        {{ $question->name }}
                    </h2>
                    <p>{{$question->description}}</p>

                    {{-- <div class="flex justify-between">

                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura, $modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar
                            </a>
                        @endrole

                                           </div> --}}

                </div>
            @endforeach
        </div>
        @if ($questions->count() > 0)
            {{ $questions->links() }}
        @endif
    </div>
</x-layouts.app>
