<x-layouts.app>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <h1 class="mx-auto text-3xl font-semibold text-gray-600 text-center">Listado de Asignaturas</h1>
    <h1 class="mx-auto text-3xl font-semibold text-gray-600 text-center">Profesor {{ auth()->user()->name }}</h1>
    <div class="container mt-10">
        <div class="card mx-auto w-full md:w-full text-center">
            <div class="card-header bg-primary text-white">
                <div class="card-title flex justify-between items-center">
                    <h4>
                        {{ __('list of asignaturas') }}
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <table id="asignatura" class="table table-hover text-[14px]" style="width:100%">
                    <thead>
                        <tr>
                            <th>Asignatura</th>
                            <th>Modulos</th>
                            <th>Estudiantes</th>
                            <th>Exámenes</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asignaturas as $asignatura)
                            <tr>
                                <td width="">{{ $asignatura->name }}</td>
                                <td width="">Módulos:{{ $asignatura->modulos->count() }}</td>
                                <td width="">Estudiantes:{{ $asignatura->students }}</td>
                                <td width="">Exámenes</td>
                                <td width=""
                                    class="flex-wrap gap-3 flex justify-between text-center mx-auto w-full flex-1">
                                    <a href="#" class="text-green-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <form action="#" method="POST" class="text-red-600">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                                            </svg>
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
</x-layouts.app>
