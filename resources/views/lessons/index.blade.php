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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">


    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            {{ $modulo->name }}
        </h2>

        {{-- @role('teacher')
                <div class="px-4 py-2 w-full bg-gray-300 rounded">
                    <a href="{{ route('lessons.create') }}">Crear lesson</a>
                </div>
            @endrole --}}

        <div class="container mt-10">
            <div class="card mx-auto w-full md:w-full text-center">
                <div class="card-header bg-primary text-white">
                    <div class="card-title flex justify-between items-center  text-center">
                        <h4 class="m-auto">
                            {{ __('list of lessons') }}
                        </h4>
                        @role('teacher')
                            <a href="{{ route('lessons.create', [$modulo->asignatura_id, $modulo->id]) }}"
                                class="text-white cursor-pointer" title="{{ __('add lesson') }}">
                                <flux:icon.plus-circle />
                            </a>
                        @endrole
                    </div>
                </div>
                <div class="card-body">
                    <table id="lesson" class="table table-hover text-[14px]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Lección</th>
                                <th>Descripción</th>
                                <th>Preguntas</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td width="">
                                        {{ $lesson->name }}<br>
                                    </td>
                                    <td>
                                        <p>{{ $lesson->description }}</p>
                                    </td>
                                    <td width="">Preguntas: {{ $lesson->questions->count() }} <br>

                                    </td>
                                    <td
                                        class="flex-col  gap-3 flex h-['100%'] justify-between  justify-items-centertext-center mx-auto w-full flex-1">

                                        <a href="{{ route('questions.create_pregunta', [$asignatura, $modulo, $lesson]) }}"
                                            class="text-green-600 mx-auto flex-1" title="Crear Pregunta">
                                            <flux:icon.clipboard-document-check />
                                        </a>
                                        <a title="Modificar lesson"
                                            href="{{ route('lessons.edit', [$asignatura, $modulo, $lesson]) }}"
                                            class="mx-auto">
                                            <flux:icon.pencil-square />
                                        </a>

                                        <form action="{{ route('asignaturas.lesson.eliminar', $lesson->id) }}"
                                            method="POST" class="text-red-600">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                                            <button type="submit" title="Eliminar Leccion">
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
                    $('#lesson').DataTable({
                        "columnDefs": [{
                            "targets": [3],
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
                @foreach ($lessons as $lesson)
                    <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">

                        <h2
                            class="uppercase text-center font-bold m-auto text-xl text-gray-700 text-wrap justify-center items-center p-4">
                            {{ $lesson->name }}
                        </h2>

                        <div class="flex justify-between">
                            @role('teacher')
                                <a href="{{ route('lessons.show', $lesson) }}"
                                    class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                    Ver Detalles
                                </a>
                            @endrole
                            @role('teacher')
                                <a href="{{ route('lessons.edit', $lesson) }}"
                                    class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                    Editar lesson
                                </a>
                            @endrole

                            @role('teacher')
                                <a href="{{ route('modulos.index', $lesson) }}"
                                    class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                    Ver Módulos
                                </a>
                            @endrole
                        </div>

                    </div>
                @endforeach
            </div>
            @if ($lessons->count() > 0)
                {{ $lessons->links() }}
            @endif --}}
    </div>
</x-layouts.app>
