<x-layouts.app :title="'Materias del Estudiantes'">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="border px-4 py-2 bg-gray-50 rounded justify-between flex"><span class="font-bold text-2xl">Estudiante:
            </span> <span>{{ auth()->user()->name }} </span> </div>
        <div class="grid  gap-4 grid-cols-1">
            <div class="container mt-10">
                <div class="border rounded mx-auto w-full md:w-full text-center px-4 py-2">
                    <div class="card-header bg-primary text-gray-600">
                        <div class="card-title flex justify-between items-center">
                            <h4>
                                {{ __('Listado de Materias') }}
                            </h4>
                            <a href="{{ route('students.inscribir') }}"
                                class="hover:bg-green-300 px-4 py-2 rounded">Inscribir Materia</a>
                        </div>
                    </div>
                    <div class="">
                        @foreach ($asignaturas as $asignatura)
                            <div class="border my-2 rounded hover:bg-green-300">
                                <a href="{{ route('students.aula', $asignatura->id) }}"
                                    class="flex flex-col gap-4 justify-between p-8 items-center border-neutral-500">
                                    <div>
                                        <h1 class="uppercase font-bold text-gray-600 text-2xl">{{ $asignatura->asignatura }}
                                        </h1>
                                        <h2>{{ $asignatura->name }}</h2>
                                        <h2 class="italic text-[14px]">Prof. {{ $asignatura->teacher }}</h2>
                                    </div>
                                    <div>
                                        <h1 class="uppercase font-bold text-gray-600 text-[16px]">Lapso o péríodo
                                        </h1>
                                        <h2 class="text-[12px] text-justify">Fecha de Inicio: {{ $asignatura->inicio->format('d-m-Y') }}</h2>
                                        <h2 class="text-[12px] text-justify">Fecha Culminación: {{ $asignatura->fin->format('d-m-Y') }}</h2>
                                        <h3 class="text-[12px] text-justify">Días restantes
                                            :{{ floor(now()->diffInDays($asignatura->fin)) > 0 ? floor(now()->diffInDays($asignatura->fin)) : 'EVENTO PASADO' }}
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        @endforeach
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
