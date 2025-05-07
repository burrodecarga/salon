<x-layouts.app :title="__('Estudiantes del Aula')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">


    <div class="flex h-full w-full flex-1 flex-col gap-2 rounded-xl">
        <h2
            class="uppercase text-justify font-bold m-auto text-xl text-gray-600 text-wrap justify-center items-center p-1 my-0">
            {{ auth()->user()->name }}
        </h2>

        <div class="container mt-10">
            <div class="card mx-auto w-full md:w-full text-center">
                <div class="card-header bg-primary text-white">
                    <div class="card-title flex justify-between items-center  text-center">
                        <h4 class="m-auto">
                            {{ __('list of students') }}
                        </h4>
                        @role('teacher')
                            <a href="{{ route('aulas.add_students', $aula) }}" class="text-white cursor-pointer"
                                title="{{ __('add students') }}">
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
                                <th>Nombre</th>
                                <th>email</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td width="">
                                        {{ $student->name }}<br>
                                    </td>
                                    <td width="">
                                        {{ $student->email }}<br>
                                    </td>

                                    <td
                                        class="flex-col  gap-3 flex h-['100%'] justify-between  justify-items-centertext-center mx-auto w-full flex-1">
                                        <a href="{{ route('modulos.create', $student->id) }}"
                                            class="text-green-600 mx-auto flex-1" title="Crear Modulo">
                                            <flux:icon.clipboard-document-list />
                                        </a>
                                        <a href="{{ route('examenes.create') }}" class="text-green-600 mx-auto flex-1"
                                            title="Crear exámen">
                                            <flux:icon.clipboard-document-check />
                                        </a>
                                        <a title="Modificar student" href="{{ route('students.edit', $student) }}"
                                            class="mx-auto">
                                            <flux:icon.pencil-square />
                                        </a>

                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                            class="text-red-600">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="student_id" value="{{ $student->id }}">
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
    </div>
</x-layouts.app>
