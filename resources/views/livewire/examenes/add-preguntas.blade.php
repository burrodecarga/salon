<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <h1 class="mx-auto text-3xl font-semibold text-gray-600 text-center">Listado de Preguntas</h1>
    <h1 class="mx-auto text-3xl font-semibold text-gray-600 text-center">Profesor {{ auth()->user()->name }}</h1>
    <div class="container mt-10">
        <div class="card mx-auto w-full md:w-full text-center">
            <div class="card-header bg-primary text-white">
                <div class="card-title flex justify-between items-center">
                    <h5 class="uppercase">
                        {{ __('listado de preguntas') }} : {{ $examen->asignatura }}
                    </h5>
                    <h6 class="uppercase">
                        total preguntas:
                        {{ $examen->questions->count() }}
                    </h6>
                </div>
            </div>
            <div class="card-body">
                <table id="pregunta" class="table table-hover text-[14px]" style="width:100%">
                    <thead>
                        <tr>
                            <th>pregunta</th>
                            <th>Modulos</th>
                            <th>Lecciones</th>
                            <th>Condición</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $pregunta)
                            <tr>
                                <td width="">
                                    <p class="text-justify">
                                        {{ $pregunta->question }}
                                    </p>
                                    <p class="text-justify bg-green-300">
                                        {{ $pregunta->correct }}
                                    </p>
                                    <p class="text-justify bg-green-300">
                                        {{ $pregunta->level }}--{{ $pregunta->type }}
                                    </p>
                                </td>
                                <td width="">Módulos: {{ $pregunta->modulo }}</td>
                                <td width="">Lección: {{ $pregunta->lesson }}</td>
                                <td width="" class="text-center mx-auto">
                                    {{ $examen->questions()->where('question_id', $pregunta->id)->exists() ? 'Están en el examen' : 'No está en el exámen' }}


                                    @if (!$examen->questions()->where('question_id', $pregunta->id)->exists())
                                        <a wire:click="add({{ $pregunta->id }})" href="#"
                                            class="text-green-600 text-center mx-auto">
                                            <flux:icon.plus-circle class="text-center mx-auto" />

                                        </a>
                                    @else
                                        <a wire:click="del({{ $pregunta->id }})" href="#"
                                            class=" text-center mx-auto">
                                            <flux:icon.minus-circle class="text-center mx-auto text-red-600" />
                                        </a>
                                    @endif
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
                $('#pregunta').DataTable({
                    "columnDefs": [{
                        "targets": [],
                        "orderable": false
                    }]

                });
                setTimeout(function() {
                    $('#alert').remove()
                }, 300)

            });
        </script>
    @endpush

</div>
