<x-layouts.app :title="__('Asignaturas')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">


    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            Asignaturas dictadas por {{ auth()->user()->name }}
        </h2>

        {{-- @role('teacher')
            <div class="px-4 py-2 w-full bg-gray-300 rounded">
                <a href="{{ route('asignaturas.create') }}">Crear Asignatura</a>
            </div>
        @endrole --}}

        <div class="container mt-10">
            <div class="card mx-auto w-full md:w-full text-center">
                <div class="card-header bg-primary text-white">
                    <div class="card-title flex justify-between items-center  text-center">
                        <h4 class="m-auto">
                            {{ __('list of asignaturas') }}
                        </h4>
                        @role('teacher')
                            <a href="{{ route('asignaturas.create') }}" class="text-white cursor-pointer"
                                title="{{ __('add asignatura') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                        @endrole
                    </div>
                </div>
                <div class="card-body">
                    <table id="asignatura" class="table table-hover text-[14px]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Asignatura</th>
                                <th>Modulos</th>
                                <th>Lecciones</th>
                                <th>Exámenes</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaturas as $asignatura)
                                <tr>
                                    <td width="">
                                        {{ $asignatura->name }}<br>
                                    </td>
                                    <td>
                                        Módulos: {{ $asignatura->modulos->count() }}
                                        <div>
                                            @forelse ($asignatura->modulos as $modulo)
                                                <a href="{{ route('asignaturas.modulo', [$modulo->id]) }}">
                                                    <p class="my-0.5 text-[10px]">{{ $modulo->name }}</p>
                                                </a>
                                            @empty
                                                <p>NO Tiene Módulos registrados</p>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td width="">Lecciones: {{ $asignatura->lessons->count() }} <br>
                                        <div>
                                            @forelse ($asignatura->lessons as $lesson)
                                                <a
                                                    href="{{ route('asignaturas.leccion', [$lesson->modulo_id, $lesson->id]) }}">

                                                    <p class="my-0.5 text-[10px]">{{ $lesson->name }}</p>
                                                </a>
                                            @empty
                                                <p>No tiene lecciones Registradas</p>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td width="">Exámenes:
                                        Total Exámenes: {{ $asignatura->examens->count() }} <br>

                                        <div class="flex flex-col gap-6">
                                            @forelse ($asignatura->examens as $examen)
                                                <div class="bg-blue-300 rounded border py-6">

                                                    <div>
                                                        <p>{{ $examen->asignatura }}</p>
                                                        <p>{{ $examen->name }} Preguntas :
                                                            {{ $examen->questions->count() }}</p>
                                                        <p>Módulo: {{ $examen->modulo }}</p>
                                                        <p>Lécción: {{ $examen->lesson }}</p>
                                                    </div>
                                                    <a href="{{ route('questions.create_pregunta', $examen->id) }}"
                                                        title="crear pregunta"
                                                        class="text-white my-0.5 text-[14px] px-4 py-2 bg-green-500">Crear
                                                        Pregunta</a>
                                                    <a href="{{ route('examenes.show', $examen->id) }}"
                                                        title="Ver preguntas"
                                                        class="text-white my-0.5 text-[14px] px-4 py-2 bg-green-500 hover:bg-blue-500">Ver
                                                        Preguntas</a>
                                                    <a href="{{ route('examenes.add_pregunta', $examen->id) }}"
                                                        title="Agregar preguntas a Exámen"
                                                        class="text-white my-0.5 text-[14px] px-4 py-2 bg-green-500 hover:bg-blue-500">Agregar
                                                        Preguntas</a>
                                                </div>
                                            @empty
                                                <p>No tiene Exámenes Registradas</p>
                                            @endforelse
                                    </td>
                                    <td
                                        class="flex-col  gap-3 flex h-['100%'] justify-between  justify-items-centertext-center mx-auto w-full flex-1">
                                        <a href="{{ route('modulos.create', $asignatura->id) }}"
                                            class="text-green-600 mx-auto flex-1" title="Crear Modulo">
                                            <flux:icon.clipboard-document-list />
                                        </a>
                                        <a href="{{ route('examenes.create') }}" class="text-green-600 mx-auto flex-1"
                                            title="Crear exámen">
                                            <flux:icon.clipboard-document-check />
                                        </a>
                                        <a title="Modificar Asignatura"
                                            href="{{ route('asignaturas.edit', $asignatura) }}" class="mx-auto">
                                            <flux:icon.pencil-square />
                                        </a>

                                        <form action="{{ route('asignaturas.destroy', $asignatura->id) }}"
                                            method="POST" class="text-red-600">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="asignatura_id" value="{{ $asignatura->id }}">
                                            <button type="submit">
                                                <flux:icon.trash />
                                            </button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        @push('script')
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


            <script>
                $(document).ready(function() {
                    $('#asignatura').DataTable({
                        "columnDefs": [{
                            "targets": [4],
                            "orderable": false
                        }]

                    });
                    setTimeout(function() {
                        $('#alert').remove()
                    }, 300)

                });
            </script>
        @endpush


        {{-- <div class="grid auto-rows-min gap-4 md:grid-cols-2">
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
        @if ($asignaturas->count() > 0)
            {{ $asignaturas->links() }}
        @endif --}}
    </div>
</x-layouts.app>
