<x-layouts.app :title="__('Asignaturas')">




    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2 class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            Asignaturas
        </h2>

        @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('asignaturas.create') }}">Crear Asignatura</a>
            </div>
        @endrole

        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            @foreach ($asignaturas as $asignatura)
                <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">

                    <h2
                        class="uppercase text-center font-bold m-auto text-xl text-gray-700 text-wrap justify-center items-center p-4">
                        {{ $asignatura->name }}
                    </h2>

                    <div class="flex justify-between">
                        @role('teacher')
                            <a href="{{ route('asignaturas.show', $asignatura) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver Detalles
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('asignaturas.edit', $asignatura) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar Asignatura
                            </a>
                        @endrole

                        @role('teacher')
                        <a href="{{ route('modulos.index', $asignatura) }}"
                            class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                            Ver Módulos
                        </a>
                    @endrole
                    </div>

                </div>
            @endforeach
        </div>
        @if($asignaturas->count()>0)
        {{$asignaturas->links()}}
        @endif
    </div>
</x-layouts.app>
