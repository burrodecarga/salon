<x-layouts.app :title="__('lecciones del modulo')">
    <a href="{{route('modulos.index',$asignatura)}}" class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        {{ $asignatura->name }}
    </a>
    <h2 class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        Módulo: {{ $modulo->name }}
    </h2>
    <h2 class="uppercase text-center font-bold m-auto text-2xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        Descripción
    </h2>

    <p class="p-3 border rounded text-justify">{{$modulo->description}}</p>

    <h2 class="uppercase text-center font-bold m-auto text-2xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
        Lecciones
    </h2>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('modulos.create', [$asignatura]) }}">Crear Lección</a>
            </div>
        @endrole

        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @foreach ($lessons as $key => $lesson)
                <div class="px-6 py-1 bg-gray-300 border border-gray-400 rounded my-0">
                    <h1 class="p-1 text-center font-bold m-auto text-[12px] uppercase text-gray-700">{{ 'Leccion  ' . $key + 1 }}
                    </h1>
                    <h2
                        class="my-0 uppercase text-center font-bold m-auto text-[12px] text-gray-700 text-wrap justify-center items-center p-4">
                        {{ $lesson->name }}
                    </h2>
                    <p>{{$lesson->description}}</p>

                    <div class="flex justify-between">
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
                    </div>

                </div>
            @endforeach
        </div>
        @if ($lessons->count() > 0)
            {{ $lessons->links() }}
        @endif
    </div>
</x-layouts.app>
