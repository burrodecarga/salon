<x-layouts.app :title="__('Modulos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <h2
            class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4 flex-1 h-6 bg-gray-100 rounded w-full uppercase">

            {{ $asignatura->name }}
        </h2>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @foreach ($modulos as $key=>$modulo)
                <div href="" class="cursor-pointer">
                    <div
                        class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <x-placeholder-pattern
                            class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20 " />
                            <h1 class="text-center font-bold m-auto text-2xl text-gray-700" >{{'Modulo  '.$key+1}}</h1>
                        <h2
                            class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4">

                            {{ $modulo->name }}
                        </h2>
                    </div>
                    <h1 class="text-center font-bold m-auto text-2xl text-gray-700" >{{'Lecciones'}}</h1>
                    @foreach ($modulo->lessons as $lesson)
                        <a href="{{route('base.index',[$modulo,$lesson])}}" class="px-4 py-2 bg-white border my-1 rounded cursor-pointer block">
                            {{ $lesson->name }}

                        </a>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app>
