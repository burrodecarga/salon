@csrf
<div class="flex gap-2 justify-between items-center">

    <div class="mb-4">
        <label class="font-bold mr-2">Nombre de Asignatura</label>
        <div>
            <select name="asignatura_id" class="bg-white px-4 py-2 rounded">
                <option value="">Selecciones una asignatura</option>
                @foreach ($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id }}" @if ($asignatura->id == $aula->asignatura_id) selected @endif>
                        {{ $asignatura->name }}</option>
                @endforeach
            </select>
        </div>
        <x-input-error for="asignatura" />
    </div>

    <div class="mb-4">
        <label class="font-bold mr-2">Nombre del Aula</label>

        <x-input required type="text" name="name" class="w-full" placeholder="{{ __('input name of aula') }}"
            value="{{ old('name', $aula->name) }}" />
        <x-input-error for="name" />
    </div>
</div>

<div class="flex gap-2 justify-between items-center">

    <div class="mb-4">
        <label class="font-bold mr-2">Inicio del período</label>
        <x-input required type="date" name="inicio" class="w-full"
            placeholder="{{ __('input inicio del período') }}"
            value="{{ old('inicio', $aula->inicio->toDateString()) }}" />
        <x-input-error for="inicio" />
    </div>
    <div class="mb-4">
        <label class="font-bold mr-2">Culminación del período</label>
        <x-input required type="date" name="fin" class="w-full" placeholder="{{ __('input fin del período') }}"
            value="{{ old('fin', $aula->fin->toDateString()) }}" />
        <x-input-error for="fin" />
    </div>

</div>


<button type="submit"
    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center cursor-pointer">
    {{ __($btn) }}

</button>

<a type="button" href="{{ route('aulas.index') }}"
    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
