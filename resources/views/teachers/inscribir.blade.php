<x-layouts.app :title="'Inscribir Estudiantes'">
    <form class="bg-gray-200 w-1/2 mx-auto p-4 my-6 rounded" action="{{ route('teachers.storeStudent') }}" method="POST">
        <h1 class="text-2xl text-gray-500 my-2 px-4 py-2 mx-auto text-center uppercase font-bold">Inscripción Estudiantil
        </h1>
        <p class="text-md text-gray-500 py-3  ">Estudiante: {{ $student->name }}</p>
        <div class="">
            @csrf
            <div class="mb-4 bg-white p-2 rounded w-full">
                {{-- <label class="font-bold mr-2 block">Selección de Aula</label> --}}
                <select name="aula_id" class="bg-white px-4 py-2 w-full">
                    <option value="">Selerccione aula y asignatura y profesor</option>
                    @foreach ($aulas as $aula)
                        <option value="{{ $aula->id }}">
                            {{ $aula->asignatura . '  - ' . $aula->name . '  -  ' . $aula->teacher }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <x-input-error for="aula_id" />
                <x-input-error for="student_id" />
            </div>

        </div>
        <button type="submit" class="px-4 py-2 rounded border outline-1 cursor-pointer hover:bg-green-400">
            Inscribir Estudiante
        </button>

        <a href="{{ route('teachers.students') }}"
            class="px-4 py-2.5 rounded border outline-1 cursor-pointer hover:bg-yellow-400 mx-4">
            Cancelar
        </a>

    </form>
</x-layouts.app>
