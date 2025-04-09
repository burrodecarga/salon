@csrf


<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('name of modulo') }}" for="name"/>
    <x-input required type="text" name="name" class="w-full" placeholder="{{ __('input name of modulo')}}"
    value="{{ old('name',$modulo->name) }}"/>
    <x-input-error for="name" />
</div>

<div class="mb-4">
    <x-label class="italic my-2 capitalize" value="{{ __('name of modulo') }}" for="description"/>
    <textarea name="description" class="w-full shadow bg-white rounded p-6 text-[13px]" rows="10" placeholder="{{ __('input description of modulo')}}"
    >{{$modulo->description}}</textarea>
    <x-input-error for="description" />
</div>


<button type="submit"
class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __($btn) }}

</button>

<a type="button" href="{{ route('modulos.index',[$asignatura,$modulo]) }}"
class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
    {{ __('cancel') }}

</a>
