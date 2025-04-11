<x-layouts.app :title="__('Opciones de Pregunta')">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex"><span class="font-bold text-2xl">Modulo:
            </span> <span> {{ $modulo->name }}</span> </div>
        <div class="grid  gap-4 grid-cols-1">

            <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex items-center text-center"><span
                    class="font-bold text-2xl text-center">Lección: </span> <span class="">
                    {{ $lesson->name }}</span></div>
            <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex items-center text-center"><span
                    class="font-bold text-2xl text-center">Pregunta: </span> <span class="">
                    {{ $question->question }}</span></div>


            <div class="container mt-10">
                <div class="card mx-auto w-full md:w-full text-center">
                    <div class="card-header bg-primary text-white">
                        <div class="card-title flex justify-between items-center">
                            <h4>
                                {{ __('Opciones de respuesta') }}
                            </h4>
                            {{--
                            <a href="#" class="text-white cursor-pointer" title="{{ __('add question') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="question" class="table table-hover text-[14px]" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Respuesta</th>
                                    <th>Valoración</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($options as $option)
                                    <tr>
                                        <td width="10%">{{ $option->id }}</td>
                                        <td width="70%">{{ $option->answer }}</td>
                                        <td width="10%">
                                            @if ($option->is_true)
                                                Verdadero
                                            @else
                                                Falso
                                            @endif
                                        </td>
                                        <td width="100%" class="flex flex-col gap-8 items-center flex-wrap">
                                            <a href="{{ route('modificar', $option) }}" class="text-green-600"
                                                title="cambiar valoración">

                                                <flux:icon.squares-plus />
                                            </a>
                                            <a href="{{ route('options.edit', $option) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('options.destroy', $option) }}" method="POST"
                                                class="text-red-600 items-center text-justify h-full">
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
                        $('#question').DataTable({
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
