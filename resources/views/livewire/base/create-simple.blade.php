<div>
    <div class="border p-3 rounded">

        <p class="w-full p-4 bg-gray-200">{{ $question->question }}</p>
        <p class="w-full p-4 bg-gray-200 mt-2">{{ $question->level }}</p>
    </div>



    <form wire:submit="save" class="bg-gray-200 w-full mx-auto p-4 my-6 rounded">
        <h1 class="font-bold uppercase text-center text-[16px] mb-6">Ingrese veracidad o no de afirmación</h1>

        <div class="flex justify-center gap-10 items-center my-4 mx-auto bg-white p-4">
            <label for="is_true" class="uppercase font-bold">
                @if (!$is_true)
                    La afirmación o pregunta es incorrecta o falsa
                @else
                    La afirmación o pregunta es correcta o verdadera
                @endif
            </label>

            <input type="checkbox" wire:model.live="is_true">
        </div>





        <button type="submit" class="px-4 py-2 rounded border outline-1 cursor-pointer hover:bg-green-400"
            wire:loading.attr="disabled">
            Agregar Opción de verdadero y falso

        </button>
        <div wire:loading class="mx-4">
            Salvando Opción...
        </div>
    </form>
    <p class="w-full p-4 bg-gray-200"><span class="font-bold text-[18px] mr-10">Listado de Opciones.</span> Opciones
        registradas : {{ $options->count() }} <span class="mx-4"> Opciones verdaderas o correctas :
            {{ $options->where('is_true', 1)->count() }}</span></p>
    @foreach ($options as $key => $item)
        <div class="flex items-center my-3 bg-gray-200 border rounded flex-1">
            <p class="flex-1 p-4 bg-white">{{ $key + 1 . '.- ' . $item->answer }}</p>
            <span class="p-4 bg-gray-200">{{ $item->is_true ? 'verdadero o correcto' : 'falso o incorrecto' }}</span>
            <span>
                <flux:icon.trash class="text-red-500 cursor-pointer" wire:click="delete({{ $item->id }})" />
            </span>
        </div>
    @endforeach
</div>
