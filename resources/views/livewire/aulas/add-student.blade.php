<div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <div class="container grid grid-cols-2 gap-2">
        <div id="estudiantes">
            <div class="">
                <div class="card mx-auto w-full md:w-full text-center">
                    <div class="card-header bg-primary text-white">
                        <div class="card-title flex justify-between items-center  text-center">
                            <h4 class="m-auto">
                                {{ __('list of students') }}
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="students" class="table table-hover text-[14px]" style="width:100%">
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
                                            <button type="button" wire:click="add({{ $student->id }})"
                                                class="text-green-600 mx-auto flex-1 cursor-pointer"
                                                title="Inscribir Estudiante">
                                                <flux:icon.plus-circle />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>


        </div>

        <div id="listos">
            <div class="">
                <div class="card mx-auto w-full md:w-full text-center">
                    <div class="card-header bg-primary text-white">
                        <div class="card-title flex justify-between items-center  text-center">
                            <h4 class="m-auto">
                                {{ __('list of students') }}
                            </h4>

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="inscritos" class="table table-hover text-[14px]" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>email</th>
                                    <th>acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscritos as $student)
                                    <tr>
                                        <td width="">
                                            {{ $student->name }}<br>
                                        </td>
                                        <td width="">
                                            {{ $student->email }}<br>
                                        </td>

                                        <td
                                            class="flex-col  gap-3 flex h-['100%'] justify-between  justify-items-centertext-center mx-auto w-full flex-1">
                                            <button type="button" wire:click="del({{ $student->id }})"
                                                class="text-green-600 mx-auto flex-1 cursor-pointer"
                                                title="Des Inscribir Estudiante">
                                                <flux:icon.minus-circle />
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                $('#students').DataTable({
                    "columnDefs": [{
                        "targets": [2],
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
                $('#inscritos').DataTable({
                    "columnDefs": [{
                        "targets": [2],
                        "orderable": false
                    }]

                });

            });
        </script>
    @endpush
</div>
