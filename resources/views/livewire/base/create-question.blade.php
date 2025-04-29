<div class="bg-gray-100 px-6 py-1 my-0 border rounded">
    <form wire:submit="save" class="bg-slate-100 w-full mx-auto p-0 my-6 rounded">
        <div class="grid grid-cols-2 p-0 bg-slate-100 rounded gap-1 justify-between items-center">
            <div class="mb-0 bg-white px-10 py-1 rounded">
                <x-label class="italic my-2 capitalize border-b" value="{{ __('type of answer') }}" for="type" />
                <select class="px-4 py-2 rounded w-full" wire:model="type">
                    <option value="multiple" @if ($type == 'multiple') selected @endif>selección múltiple
                    </option>
                    <option value="simple" @if ($type == 'simple') selected @endif>selección simple</option>
                </select>
                <x-input-error for="type" />
            </div>
            <div class="mb-0 bg-white px-10 py-1 rounded">
                <x-label class="italic my-2 capitalize border-b" value="{{ __('level of answer') }}" for="level" />
                <select class="px-4 py-2 rounded w-full" wire:model="level">
                    <option value="dificultad baja" @if ($level = 'dificultad baja') selected @endif>dificultad baja
                    </option>
                    <option value="dificultad baja-media" @if ($level = 'dificultad baja-media') selected @endif>dificultad
                        baja-media
                    </option>
                    <option value="dificultad media" @if ($level = 'dificultad media') selected @endif>dificultad media
                    </option>
                    <option value="dificultad media-alta" @if ($level = 'dificultad media-alta') selected @endif>dificultad
                        media-alta
                    </option>
                    <option value="dificultad alta" @if ($level = 'dificultad alta') selected @endif>dificultad alta
                    </option>
                </select>
                <x-input-error for="level" />
            </div>
            <div class="mb-0 bg-white px-10 py-2 rounded">
                <x-label class="italic my-2 capitalize border-b" value="{{ __('Módulo') }}" for="level" />
                <select class="px-0 py-2 rounded w-full" wire:model="modulo_id">
                    <option value="dificultad baja">Seleccione Módulo</option>
                    @forelse ($modulos as $modulo)
                        <option value="{{ $modulo->id }}" @if ($modulo_id == $modulo->id) selected @endif>
                            {{ $modulo->name }}
                        </option>
                    @empty
                        <option>N/D</option>
                    @endforelse
                </select>
                <x-input-error for="modulo_id" />
            </div>
            <div class="mb-0 bg-white px-10 py-2 rounded">
                <x-label class="italic my-2 capitalize border-b" value="{{ __('Lección') }}" for="level" />
                <select class="px-0 py-2 rounded w-full" wire:model="lesson_id">
                    <option value="dificultad baja">Seleccione Lección</option>
                    @forelse ($lessons as $lesson)
                        <option value="{{ $lesson->id }}" @if ($lesson_id == $lesson->id) selected @endif>
                            {{ $lesson->name }}
                        </option>
                    @empty
                        <option>N/D</option>
                    @endforelse
                </select>
                <x-input-error for="lesson_id" />
            </div>
        </div>
        <div class="my-1 w-full bg-white rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Pregunta') }}</span>
            <x-input wire:model="pregunta" type="text" required
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>
        <div class="my-1 w-full bg-white rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Respuesta Correcta') }}</span>
            <x-input wire:model="correct" type="text" required
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>

        <div class="my-1 w-full bg-white rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Explicación de Respuesta') }}</span>
            <x-input wire:model="explain" type="text" required
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>



        <div class="my-1 w-full bg-red-100 rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Opción Incorrecta 1') }}</span>
            <x-input wire:model="op1" type="text"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>
        <div class="my-1 w-full bg-red-100 rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Opción Incorrecta 2') }}</span>
            <x-input wire:model="op2" type="text"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>
        <div class="my-1 w-full bg-red-100 rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Opción Incorrecta 3') }}</span>
            <x-input wire:model="op3" type="text"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>
        <div class="my-1 w-full bg-red-100 rounded px-10 py-4">
            <span class="mb-0 text-md">{{ __('Ingrese Opción Incorrecta 4') }}</span>
            <x-input wire:model="op4" type="text"
                class="w-full p-2 border border-gray-300 rounded-md placeholder:font-light placeholder:text-gray-500" />
        </div>

        <div class="flex justify-between items-center px-10 mx-10 bg-slate-100">
            <button type="submit"
                class="w-1/4 p-2 mb-6 text-white bg-blue-500 rounded-lg hover:bg-white hover:text-black hover:border hover:border-gray-300 capitalize">
                {{ __('Guardar Pregunta') }}
            </button>
            <button type="submit"
                class="w-1/4 p-2 mb-6 text-white bg-yellow-500 rounded-lg hover:bg-white hover:text-black hover:border hover:border-gray-300 capitalize">
                {{ __('Cancelar') }}
            </button>
        </div>

    </form>
</div>
