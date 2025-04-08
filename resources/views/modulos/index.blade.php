<x-layouts.app :title="__('modulos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <a href="{{route('asignaturas.index')}}" class="uppercase font-bold text-xl text-gray-600 text-wrap p-1 my-0">
            {{ $asignatura->name }}
        </a>
        <h2 class="uppercase text-justify font-bold text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            Módulos
        </h2>
        @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('modulos.create',[$asignatura]) }}">Crear modulo</a>
            </div>
        @endrole

        <div class="grid auto-rows-min gap-4 md:grid-cols-2">
            @foreach ($modulos as $key=>$modulo)
                <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">
                    <h1 class="text-center font-bold m-auto text-[16px] uppercase text-gray-700" >{{'Modulo  '.$key+1}}</h1>
                    <h2
                        class="uppercase text-center font-bold m-auto text-[13px] text-gray-700 text-wrap justify-center items-center mt-4 mb-6">
                        {{ $modulo->name }}
                    </h2>

                    <div class="flex justify-between">
                        @role('teacher')
                            <a href="{{ route('modulos.show', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar
                            </a>
                        @endrole

                        @role('teacher')
                        <a href="{{ route('lessons.index', [$asignatura,$modulo]) }}"
                            class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                           Lecciones
                        </a>
                    @endrole
                    </div>

                </div>
            @endforeach
        </div>
        @if($modulos->count()>0)
        {{$modulos->links()}}
        @endif
    </div>
</x-layouts.app>
