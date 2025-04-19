<div class="">
    <div class="flex justify-between items-center mb-4 border p-4">
        <h3 class="text-sm text-center">Estudiantes que solicitan intervenir</h3>
        <div>
            <button class="px-4 py-2 rounded bg-green-100 mx-3" wire:click="actualizar">Actualizar</button>
            <button class="px-4 py-2 rounded bg-red-200" wire:click="cerrar">Cerrar
                Pregunta</button>
        </div>
    </div>
    @foreach ($solicitudes as $key => $solicitud)
        <div class="flex justify-between items-center bg-neutral-300 p-2 gap-4">
            <button class="px-4 py-2 rounded bg-gray-100 flex-1 text-justify">{{ $key + 1 }} -
                {{ $solicitud->student }}</button>
            <div>
                <button class="px-4 py-2 rounded bg-gray-100"
                    wire:click="evaluar( 4 , {{ $solicitud->id }})">notable</button>
                <button class="px-4 py-2 rounded bg-gray-100"
                    wire:click="evaluar( 3 , {{ $solicitud->id }})">regular</button>
                <button class="px-4 py-2 rounded bg-gray-100"
                    wire:click="evaluar( 2 , {{ $solicitud->id }})">suficiente</button>
                <button class="px-4 py-2 rounded bg-gray-100"
                    wire:click="evaluar( 1 , {{ $solicitud->id }})">deficiente</button>
            </div>

        </div>
    @endforeach
</div>
