<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <div class="flex flex-col justify-between items-center p-4 border rounded">
                <p class="font-bold">Primer paso: </p>
                <p class="font-bold">Configurar asignatura</p>
                <p class="text-justify text-wrap">En este punto se crearán todas las asignaturas a dictarse en el
                    período lectivo</p>
                <p class="font-bold">Pulse Agregar Asignatura</p>
            </div>
            <div class="flex flex-col justify-between items-center p-4 border rounded">
                <p class="font-bold">Segundo paso: </p>
                <p class="font-bold">Configurar Aulas o secciones</p>
                <p class="text-justify text-wrap">En este punto se crearán todas las secciones o aulas de clases del
                    período lectivo</p>
                <p class="font-bold">Pulse Aulas o Secciones</p>
            </div>
</x-layouts.app>
