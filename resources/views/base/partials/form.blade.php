@csrf
<div class="">

    <div class="flex-1 mb-4">
        <x-label class="italic capitalize text-gray-600" value="{{ __('question of lesson') }}" for="question" />
        <x-input required type="text" name="question" class="w-full" placeholder="{{ __('input question of lesson') }}"
            value="{{ old('question', $question->question) }}" />
        <x-input-error for="question" />
    </div>
    <div class="flex gap-10">
        <div class="mb-4">
            <x-label class="italic capitalize text-gray-600" value="{{ __('level of dificult') }}" for="level" />
            <select name="level" class="w-full rounded bg-white px-4 py-2 text-gray-600">
                <option value="dificultad baja">dificultad baja</option>
                <option value="dificultad baja-media">dificultad baja-media</option>
                <option value="dificultad media">dificultad media</option>
                <option value="dificultad media-baja">dificultad media-baja</option>
                <option value="dificultad alta">dificultad alta</option>
            </select>
            <x-input-error for="level" />
        </div>
        <div class="mb-4">
            <x-label class="italic capitalize text-gray-600" value="{{ __('type of dificult') }}" for="type" />
            <select name="type" class="w-full rounded bg-white px-4 py-2 text-gray-600">
                <option value="multiple">seleccion múltiple</option>
                <option value="simple">seleccion simple</option>
            </select>
            <x-input-error for="type" />
        </div>

    </div>
</div>


<button type="submit"
    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __($btn) }}

</button>

<a type="button" href="{{ url()->previous() }}"
    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
