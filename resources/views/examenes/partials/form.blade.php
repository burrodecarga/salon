@csrf

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('type of answer') }}" for="level" />
    <select name="type">
        <option value="multiple" @if ($examen->type == 'multiple') selected @endif>selección múltiple</option>
        <option value="simple" @if ($examen->type == 'simple') selected @endif>selección simple</option>
    </select>
    <x-input-error for="type" />
</div>

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('level of answer') }}" for="level" />
    <select name="level">
        <option value="dificultad baja" @if ($examen->level == 'dificultad baja') selected @endif>dificultad baja</option>
        <option value="dificultad baja-media" @if ($examen->level == 'dificultad baja-media') selected @endif>dificultad baja-media
        </option>
        <option value="dificultad media" @if ($examen->level == 'dificultad media') selected @endif>dificultad media</option>
        <option value="dificultad media-alta" @if ($examen->level == 'dificultad media-alta') selected @endif>dificultad media-alta
        </option>
        <option value="dificultad alta" @if ($examen->level == 'dificultad alta') selected @endif>dificultad alta</option>
    </select>
    <x-input-error for="level" />
</div>




<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('examen of examen') }}" for="examen" />
    <x-input required type="text" name="examen" class="w-full" placeholder="{{ __('input name of examen') }}"
        value="{{ old('name', $examen->name) }}" />
    <x-input-error for="examen" />
</div>

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('answer of examen') }}" for="answer" />
    <x-input required type="text" name="answer" class="w-full" placeholder="{{ __('input name of examen') }}"
        value="{{ old('name', $examen->name) }}" />
    <x-input-error for="answer" />
</div>




<button type="submit"
    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __($btn) }}

</button>

<a type="button" href="#"
    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
