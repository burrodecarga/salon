<x-layouts.app :title="'Listado de Aulas'">
    <h1 class="text-2xl font-bold uppercase text-center my-4">Ingresar a Salón de Clases</h1>
    <div>
        @foreach ($aulas as $aula)
            <div class="border rounded px-6 py-4 my-4">
                <h2 class="text-gray-600 text-xl uppercase my-2">{{ $aula->asignatura }}</h2>
                <a href="{{ route('teachers.salon', $aula->id) }}"
                    class="text-gray-600 hover:bg-green-500 hover:text-white px-4 py-2 rounded">Ingresar a
                    {{ $aula->name }}</a>
            </div>
        @endforeach
    </div>
</x-layouts.app>
