<x-layouts.app :title="__('Modulo')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">


    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h6
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            {{ $modulo->asignatura->name }}
        </h6>
        <h6
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            {{ $modulo->name }}
        </h6>
        <h6
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            Lección:{{ $lesson->name }}
        </h6>
        <div class="container mt-10">
            <div class="card mx-auto w-full md:w-full text-center">
                <div class="card-header bg-primary text-white">
                    <div class="card-title flex justify-between items-center  text-center">
                        <h4 class="m-auto">
                            {{ __('list of questions') }}
                        </h4>
                        @role('teacher')
                            <a href="{{ route('questions.create', [$modulo->asignatura_id, $modulo->id, $lesson->id]) }}"
                                class="text-white cursor-pointer" title="{{ __('add question') }}">
                                <flux:icon.plus-circle />
                            </a>
                        @endrole
                    </div>
                </div>
                <div class="card-body">
                    <table id="asignatura" class="table table-hover text-[14px]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Pregunta</th>
                                <th>Respuesta</th>
                                <th>Explicación</th>
                                <th>Opciones</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td width="">
                                        {{ $question->question }}<br>
                                    </td>
                                    <td>
                                        <p>{{ $question->correct }}</p>
                                    </td>
                                    <td width="">
                                        <p>{{ $question->explain }}</p>
                                    </td>
                                    <td width="">
                                        @forelse ($question->options as $option)
                                            <p>{{ $option->answer }}</p>
                                        @empty
                                        @endforelse

                                    <td
                                        class="flex-col  gap-3 flex h-['100%'] justify-between  justify-items-centertext-center mx-auto w-full flex-1">
                                        <a href="#" class="text-green-600 mx-auto flex-1" title="Crear Modulo">
                                            <flux:icon.clipboard-document-list />
                                        </a>
                                        <a href="#" class="text-green-600 mx-auto flex-1" title="Crear exámen">
                                            <flux:icon.clipboard-document-check />
                                        </a>
                                        <a title="Modificar question" href="#" class="mx-auto">
                                            <flux:icon.pencil-square />
                                        </a>

                                        <form action="" method="POST" class="text-red-600">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="question_id" value="{{ $question->id }}">
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
                    $('#question').DataTable({
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
            @foreach ($questions as $question)
                <div class="px-6 py-2 bg-gray-300 border border-gray-400 rounded">

                    <h2
                        class="uppercase text-center font-bold m-auto text-xl text-gray-700 text-wrap justify-center items-center p-4">
                        {{ $question->name }}
                    </h2>

                    <div class="flex justify-between">
                        @role('teacher')
                            <a href="{{ route('questions.show', $question) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver Detalles
                            </a>
                        @endrole
                        @role('teacher')
                            <a href="{{ route('questions.edit', $question) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Editar question
                            </a>
                        @endrole

                        @role('teacher')
                            <a href="{{ route('modulos.index', $question) }}"
                                class="cursor-pointer px-4 py-2 bg-gray-300 border border-white  z-99 rounded">
                                Ver Módulos
                            </a>
                        @endrole
                    </div>

                </div>
            @endforeach
        </div>
        @if ($questions->count() > 0)
            {{ $questions->links() }}
        @endif --}}
    </div>
</x-layouts.app>
