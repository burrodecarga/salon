<x-layouts.app :title="__('Asignaturas')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($asignaturas as $asignatura )
            <flux:tooltip content="{{'ver módulos de '.$asignatura->name}} ">
            <a href="{{route('asignaturas.show',$asignatura)}}" class="cursor-pointer">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                    <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20 " />
                    <h2 class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4">

                        {{$asignatura->name}}
                    </h2>
                </div>
            </a>
            </flux:tooltip>

            @endforeach
        </div>
    </div>
</x-layouts.app>
