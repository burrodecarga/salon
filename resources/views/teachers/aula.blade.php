<x-layouts.app :title="'Aula'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="rounded py-2 px-4 flex flex-col gap-0.5 justify-between items-center">
            <h3 class="uppercase">{{ $aula->asignatura }}</h3>
            <h4 class="">{{ $aula->name }}</h4>
            <h4 class="">{{ $aula->teacher }}</h4>
        </div>
        <div class="grid grid-cols-1 auto-rows-min gap-4 md:grid-cols-2">
            <div class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-4 mx-auto z-99">
                    <h4 class="text-center mb-3">listado de estudiantes</h4>
                    <table id="student" class="table table-hover text-[14px]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre/email</th>
                                <th>acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td width="100%" class="text-justify">
                                        <div>{{ $student->name }}</div>
                                        <div>{{ $student->email }}</div>

                                    </td>

                                    <td width="100%" class="flex gap-8 items-center flex-col justify-between">
                                        <a href="{{ route('students.inscribir', $student->id) }}" class="text-green-600"
                                            title="Inscribir en asignatura">

                                            <flux:icon.folder-plus />
                                        </a>

                                        <form action="{{ route('students.destroy', $student) }}" method="POST"
                                            class="text-red-600 items-center text-justify h-full"
                                            title="eliminar exámen">
                                            @csrf
                                            @method('DELETE')
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
            <div class="relative aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-4 mx-auto z-99">
                    <h4 class="text-center mb-3">listado de exámenes</h4>
                    <table id="examen" class="table table-hover text-[14px]" style="width:100%">
                        <thead>
                            <tr>
                                <th>Exámen</th>
                                <th>acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($examenes as $examen)
                                <tr>
                                    <td width="100%" class="text-justify">
                                        <div>{{ $examen->name }}</div>
                                        <div>{{ $examen->asignatura }}</div>
                                        <div>{{ $examen->type }}</div>
                                        <div class="bg-green-500 text-white">{{ $examen->activo == 1 ? 'Activo' : '' }}
                                        </div>
                                    </td>

                                    <td width="100%" class="flex gap-8 items-center flex-col justify-between">
                                        <a href="{{ route('teachers.activar', [$examen->id, 1]) }}"
                                            class="text-green-600" title="Activar Exámen">

                                            <flux:icon.clipboard-document-list class="text-green-500" />
                                        </a>

                                        <a href="{{ route('teachers.activar', [$examen->id, 0]) }}"
                                            class="text-red-600" title="Desctivar Exámen">

                                            <flux:icon.clipboard-document-list class="text-red-500" />
                                        </a>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div
                class="col-span-1 md:col-span-2 p-6 w-full bg-white rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('teacher-interview-control', ['aula' => $aula])
            </div>

            <div
                class="col-span-1 md:col-span-2 p-6 w-full bg-white rounded-xl border border-neutral-200 dark:border-neutral-700">
                @livewire('listado-de-notas', ['aula' => $aula])
            </div>
        </div>
    </div>
    @push('script')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


        <script>
            $(document).ready(function() {
                $('#student').DataTable({
                    "columnDefs": [{
                        "targets": [1],
                        "orderable": false
                    }]

                });
                setTimeout(function() {
                    $('#alert').remove()
                }, 300)

            });
        </script>

        <script>
            $(document).ready(function() {
                $('#examen').DataTable({
                    "columnDefs": [{
                        "targets": [1],
                        "orderable": false
                    }]

                });

            });
        </script>
    @endpush

</x-layouts.app>
