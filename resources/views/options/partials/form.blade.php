@csrf

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('answer of lesson') }}" for="answer" />
    <x-input required type="text" name="answer" class="w-full" placeholder="{{ __('input answer of question') }}"
        value="{{ old('name', $option->answer) }}" />
    <x-input-error for="answer" />
</div>

<div class="flex justify-start gap-10 items-center my-4 px-4 py-2 rounded bg-white">
    <label for="istrue">
        la opción es correcta o verdadera
    </label>

    <input type="checkbox" name="istrue" @if ($option->is_true == 1) checked @endif />
</div>




<button type="submit"
    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __($btn) }}

</button>

<a type="button" href="#"
    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
