<form wire:submit="save" class="bg-gray-200 w-1/2 mx-auto p-4 my-6 rounded">
    <h1 class="text-2xl font-gray-600 mx-auto my-2">Crear Exámen</h1>
    <div class="flex flex-col">
        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Exámen</label>
            <select wire:model.live="examen">
                <option value="1er parcial">1er parcial</option>
                <option value="2do parcial">2do parcial</option>
                <option value="3er parcial">3er parcial</option>
                <option value="4to parcial">4to parcial</option>
                <option value="final">final</option>
                <option value="recuperacion">recuperación</option>
                <option value="especial">especial</option>
            </select>
            <x-input-error for="selectedAsignatura" />
        </div>

        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">asignatura</label>
            <select wire:model.live="selectedAsignatura">
                <option value="">Selecciones una asignatura</option>
                @foreach ($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id }}">{{ $asignatura->name }}</option>
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
    {{--
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
    </div> --}}

    <div class="mb-4 bg-gray-100 p-2 rounded w-full">
        <label class="font-bold mr-2">Cantidad de Preguntas a crear</label>
        <p class="px-4 py-2 w-full bg-white">{{ $preguntas }} </p>
    </div>
    <div class="grid grid-cols-2 gap-3">
        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Selección Simple</label>
            <select wire:model.live="simples">
                <option value="0">0</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="25">35</option>
                <option value="30">40</option>
                <option value="30">45</option>
                <option value="30">50</option>
            </select>
            <x-input-error for="level" />
        </div>
        <div class="mb-4 bg-gray-100 p-2 rounded w-full">
            <label class="font-bold mr-2">Selección Múltiple</label>
            <select wire:model.live="multiples">
                <option value="0">0</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="25">35</option>
                <option value="30">40</option>
                <option value="30">45</option>
                <option value="30">50</option>
            </select>
            <x-input-error for="level" />
        </div>
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
