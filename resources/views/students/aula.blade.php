<x-layouts.app :title="'Actividades de Aula'">
    <div class="flex h-full w-full flex-1 flex-col gap-1 rounded-xl">
        <div class="border px-4 py-2 bg-gray-50 rounded justify-between flex"><span class="font-bold text-2xl">Estudiante:
            </span> <span>{{ auth()->user()->name }} </span> </div>
        <div class="border px-4 py-2 bg-gray-50 rounded justify-between flex"><span class="font-bold text-2xl">Asignatura:
            </span> <span>{{ $asignatura->name }} </span> </div>
        <div class="border px-4 py-2 bg-gray-50 rounded justify-between flex"><span class="font-bold text-2xl">Sección:
            </span> <span>{{ $aula->name }} </span> </div>
        <div class="grid  gap-4 grid-cols-1">
            <div class="container mt-10">
                <div class="border rounded mx-auto w-full md:w-full text-center px-4 py-2">
                    <div class="card-header bg-primary text-gray-600">
                        <div class="">
                            <h4 class="text-2xl font-bold text-gray-600 text-center my-3">
                                {{ __('Información sobre asignatura') }}
                            </h4>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border border-neutral-600 rounded px-4 py-2">
                            <h2 class="text-center">Evaluaciones Pendientes</h2>
                            @foreach ($examenes as $examen)
                                <a href="{{ route('students.evaluar', [$examen, $aula]) }}"
                                    class="bg-neutral-100 px-4 py-2 block rounded border hover:bg-green-500 hover:text-white">
                                    <div>{{ $examen->name }}</div>
                                    <div>{{ $examen->asignatura }}</div>
                                </a>
                            @endforeach
                        </div>
                        <div class="border border-neutral-600 rounded px-4 py-2">
                            <h2 class="text-center">Intervenciones en clase</h2>
                            @livewire('add-interview', ['aula' => $aula])

                        </div>
                    </div>

                </div>

            </div>





            @push('script')
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


                <script>
                    $(document).ready(function() {
                        $('#teacher').DataTable({
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
        </div>
    </div>
</x-layouts.app>
