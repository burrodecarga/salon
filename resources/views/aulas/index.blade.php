<x-layouts.app :title="'Listado de Aulas'">
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
                                {{ __('Listado de Aulas o Secciones') }}
                            </h4>

                            <a href="{{ route('aulas.create') }}" class="text-white cursor-pointer"
                                title="{{ __('add aula') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="aula" class="table table-hover text-[14px]" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Asignatura</th>
                                    <th>Aula</th>
                                    <th>Período</th>
                                    <th>Estudiantes</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aulas as $aula)
                                    <tr>
                                        <td width="">{{ $aula->asignatura }}</td>
                                        <td width="">{{ $aula->name }}</td>
                                        <td width="" class="text-wrap">
                                            {{ $aula->periodo }}
                                        </td>
                                        <td width="" class="text-wrap">
                                            estudiantes
                                        </td>
                                        <td width="" class="flex gap-8 items-center flex-wrap">
                                            <a href="{{ route('aulas.show', $aula->id) }}" class="text-green-600"
                                                title="ver detalles de la sección o aula">

                                                <flux:icon.squares-plus />
                                            </a>
                                            <a href="{{ route('aulas.edit', $aula->id) }}" class="text-green-600"
                                                title="ver preguntas de exámen">

                                                <flux:icon.pencil-square />
                                            </a>

                                            <form action="{{ route('aulas.destroy', $aula) }}" method="POST"
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
                        $('#aula').DataTable({
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
    </div>
</x-layouts.app>
