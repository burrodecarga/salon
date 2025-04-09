<x-layouts.app :title="__('modulos')">

      <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            @include('nav.asignatura')
            @include('nav.modulos_str')
        </ol>
    </nav>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <a href="{{route('asignaturas.index')}}" class="uppercase font-bold text-2xl text-gray-600 text-wrap p-1 my-2 text-center">
            Módulos de {{ $asignatura->name }}
        </a>

        @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('modulos.create',[$asignatura]) }}">Crear modulo</a>
            </div>
        @endrole

        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @foreach ($modulos as $key=>$modulo)
                <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">
                    <h1 class="text-center font-bold m-auto text-[16px] uppercase text-gray-700" >{{'Modulo  '.$key+1}}</h1>
                    <h2
                        class="uppercase text-center font-bold m-auto text-[13px] text-gray-700 text-wrap justify-center items-center mt-4 mb-6">
                        {{ $modulo->name }}
                    </h2>

                    <div class="flex justify-between">
                        @role('teacher')
                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Modificar Módulo
                            </a>
                        @endrole
                            <a href="{{ route('modulos.show', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver Detalles del Módulo
                            </a>
                        @endrole

                        @role('teacher')
                        <a href="{{ route('lessons.index', [$asignatura,$modulo]) }}"
                            class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                           Ver y crear Lecciones del Módulo
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
