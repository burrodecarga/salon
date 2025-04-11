<div>
    <div class="border p-3 rounded">

        <p class="w-full p-4 bg-gray-200">{{ $question->question }}</p>
        <p class="w-full p-4 bg-gray-200 mt-2">{{ $question->level }}</p>
    </div>



    <form wire:submit="save" class="bg-gray-200 w-full mx-auto p-4 my-6 rounded">
        <h1 class="font-bold uppercase text-center text-[16px] mb-6">Ingrese Opción de respuesta a pregunta</h1>
        @if ($is_multiple)
            <div>
                <div class="flex items-center justify-between my-2">

                    <label for="anwer">Opción de respuesta a pregrunta</label>
                    <p class="p-2 bg-white">Nota: se debe agregar sólo una opción
                        correcta o
                        verdadera.</p>
                </div>
                <input type="text" wire:model="answer" class="px-4 py-2 w-full bg-white" />
                <div class="text-xs text-red-500">
                    @error('answer')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        @endif
        <div class="flex justify-start gap-10 items-center my-4">
            <label for="is_true">
                @if (!$is_true)
                    La opción es incorrecta o falsa
                @else
                    la opción es correcta o verdadera
                @endif
            </label>

            <input type="checkbox" wire:model.live="is_true">
        </div>

        <div class="flex justify-start gap-10 items-center my-4">
            <label for="is_multiple">
                @if ($is_multiple)
                    pregunta de selección múltiple
                @endif
            </label>
            <label for="is_multiple" class="justify-start">
                @if (!$is_multiple)
                    pregunta de verdadero y falso
                @endif
            </label>
            @if ($question->options->count() == 0)
                <input type="checkbox" wire:model.live="is_multiple">
            @endif
        </div>



        <button type="submit" class="px-4 py-2 rounded border outline-1 cursor-pointer hover:bg-green-400"
            wire:loading.attr="disabled">
            @if ($is_multiple)
                Agregar Opción de selección múltiple
            @else
                Agregar Opción de verdadero y falso
            @endif
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
