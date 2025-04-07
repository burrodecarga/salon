<x-layouts.app :title="__('Preguntas')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="border px-4 py-2 bg-gray-100 rounded"><span class="font-bold text-2xl"> Preguntas del Modulo:  </span> <span> {{$modulo->name}}</span> </div>
        <div class="grid  gap-4 grid-cols-1">

            <div class="border px-4 py-2 bg-gray-100 rounded justify-start flex items-center"><span class="font-bold text-2xl">Preguntas de la Lección:  </span> <span class=""> {{$lesson->name}}</span></div>
            <div class="border px-4 py-2 bg-gray-100 rounded"><span class="font-bold text-2xl"> Descripción:  </span> <span> {{$lesson->description}}</span>{{$lesson->id}} </div>

            <div class="border px-4 py-2 bg-gray-100 rounded"><span class="font-bold text-2xl"> Temática:  </span>
            <div class="w-full bg-gray-100">
                @foreach ($lesson->questions as $key=>$question )
                <div><span class="font-bold text-gray-700">{{$key+1}}.</span> <span>{{$question->question}}</span>
                <p><span class="text-gray-600 ml-3 italic">{{$question->answer}}</p></div>
                @endforeach

            </div>
            </div>


        </div>
    </div>
</x-layouts.app>
