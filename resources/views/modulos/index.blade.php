<x-layouts.app :title="__('modulos')">
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
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{$asignatura->name}}</span>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Módulos</span>
            </div>
          </li>

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
                            <a href="{{ route('modulos.show', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver Detalles del Módulo
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('modulos.edit', [$asignatura,$modulo]) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar Módulo
                            </a>
                        @endrole

                        @role('teacher')
                        <a href="{{ route('lessons.index', [$asignatura,$modulo]) }}"
                            class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                           Ver Lecciones del Módulo
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
