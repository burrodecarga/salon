<x-layouts.app :title="'Listado de Estudiantes'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex"><span class="font-bold text-2xl">Profesor:
            </span> <span>{{ auth()->user()->name }} </span> </div>
        <div class="grid  gap-4 grid-cols-1">
            <div class="container mt-10">
                <div class="card mx-auto w-full md:w-full text-center">
                    <div class="card-header bg-primary text-white">
                        <div class="card-title flex justify-between items-center">
                            <h4>
                                {{ __('Listado de Estudiantes') }}
                            </h4>

                            <a href="{{ route('students.create') }}" class="text-white cursor-pointer"
                                title="{{ __('add student') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="student" class="table table-hover text-[14px]" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>email</th>
                                    <th>Asignaturas</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td width="35%" class="text-justify">{{ $student->name }}</td>
                                        <td width="20%" class="text-justify">{{ $student->email }}</td>
                                        <td width="35%" class="text-wrap">
                                            @foreach ($student->aulas as $aula)
                                                <p class="text-[12px] text-wrap">{{ $aula->asignatura }}
                                                    - {{ $aula->name }} - Prof. {{ $aula->teacher }} </p>
                                            @endforeach
                                        </td>

                                        <td width="100%" class="flex gap-8 items-center flex-col justify-between">
                                            <a href="{{ route('students.inscribir', $student->id) }}"
                                                class="text-green-600" title="Inscribir en asignatura">

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

            </div>





            @push('script')
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


                <script>
                    $(document).ready(function() {
                        $('#student').DataTable({
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
