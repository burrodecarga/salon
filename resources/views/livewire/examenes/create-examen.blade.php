<form wire:submit="save" class="bg-gray-200 w-1/2 mx-auto p-4 my-6 rounded">
    <div class="flex flex-col">
        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Asignatura</label>
            <select wire:model.live="selectedAsignatura">
                <option value="">seleccione una asignatura</option>
                @foreach ($asignaturas as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <x-input-error for="selectedAsignatura" />
        </div>

        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Módulo</label>
            <select wire:model.live="selectedModulo">
                <option value="">todos los módulos</option>
                @foreach ($modulos as $modulo)
                    <option value="{{ $modulo->id }}">{{ $modulo->name }}</option>
                @endforeach
            </select>
            <x-input-error for="selectedModulo" />
        </div>

        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Lección</label>
            <select wire:model.live="selectedLesson">
                <option value="">todas las lecciones</option>
                @foreach ($lessons as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                @endforeach
            </select>
            <x-input-error for="level" />
        </div>
    </div>

    <div class="mb-4 bg-gray-100 p-2 rounded w-full">
        <label class="font-bold mr-2">Cantidad de Preguntas a crear</label>
        <input type="text" wire:model.live="preguntas" class="px-4 py-2 w-full bg-white" />
    </div>

    <div class="mb-4 bg-gray-100 p-2 rounded w-full">
        <label class="font-bold mr-2">Preguntas de Selección Simple (verdadero-Falso)</label>
        <input type="numeric" wire:model="simples" class="px-4 py-2 w-full bg-white" />
    </div>
    @if ($selectedAsignatura != 0)
        <button type="submit" class="px-4 py-2 rounded border outline-1 cursor-pointer hover:bg-green-400"
            wire:loading.attr="disabled">
            Crear Exámen
        </button>
        <div wire:loading class="mx-4">
            Creando Exámen...
        </div>
    @endif

</form>
