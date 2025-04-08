<x-layouts.app :title="__('Modulos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl border p-2">

        <h2
            class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4 flex-1 h-6 bg-gray-100 rounded w-full uppercase">
            {{ $asignatura->name }}
        </h2>
        <h3 class="uppercase text-gray-600">{{__('description')}}:</h3>
        <p class="text-justify text-gray-500">{{$asignatura->description}}</p>
        <h2
        class="text-center font-bold m-auto text-2xl text-gray-700 text-wrap justify-center items-center p-4 flex-1 h-6 bg-gray-100 rounded w-full uppercase">
        {{ __('modulos') }}
    </h2>
        <div class="grid auto-rows-min gap-x-4 gap-y-8 md:grid-cols-2">
            @foreach ($modulos as $key=>$modulo)
                <div href="" class="cursor-pointer border rouded p-1 bg-gray-50 rounded">
                    <div
                        class="h-36 rounded-xl border border-neutral-200 dark:border-neutral-700">

                            <h1 class="p-3 text-center font-bold m-auto text-xl uppercase text-gray-700" >{{'Modulo  '.$key+1}}</h1>
                        <h2
                            class="text-center font-bold m-auto text-md text-gray-700 text-wrap justify-center items-center p-4">

                            {{ $modulo->name }}
                        </h2>
                    </div>
                    <div>
                        <h1 class="text-center font-bold m-auto text-xl text-gray-700 bg-gray-200 rounded my-1 uppercase" >{{'descripción'}}</h1>
                    <p class="w-full bg-white px-3 text-wrap h-auto text-gray-600 text-sm/6 text-justify">{{$modulo->description}}</p>
                    </div>
                    <h1 class="text-center font-bold m-auto text-xl text-gray-700 bg-gray-200 rounded my-1 uppercase" >{{'Lecciones'}}</h1>
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
