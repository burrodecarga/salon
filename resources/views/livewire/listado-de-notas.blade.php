@php
    $students = [];
@endphp
<div class="p-4 mx-auto z-99">
    <h4 class="text-center mb-3">listado de estudiantes</h4>
    <table id="notas" class="table table-hover text-[14px]" style="width:100%">
        <thead>
            <tr>
                <th>Nombre/email</th>
                <th>acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($aula->students as $student)
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
                            class="text-red-600 items-center text-justify h-full" title="eliminar exámen">
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
    <script>
        $(document).ready(function() {
            $('#notas').DataTable({
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
</div>
