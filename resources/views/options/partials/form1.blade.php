@csrf

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('opción de respuesta') }}" for="answer" />
    <x-input required type="text" name="answer" class="w-full" placeholder="{{ __('input answer of question') }}"
        value="{{ old('name', $option->answer) }}" />
    <x-input-error for="answer" />
</div>



<button type="submit"
    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __($btn) }}

</button>

<a type="button" href="{{ route('asignaturas.leccion', [$modulo->id, $lesson->id]) }}"
    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
