<div class="border rounded-md p-4 w-full mx-auto max-w-2xl">
    <h4 class="text-xl lg:text-2xl font-semibold">
        {{ $pregunta }}
    </h4>
    <div>
        @foreach ($opciones as $opcion)
            <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300 cursor-pointer ">
                <input type="radio" name="Country">
                <i class="pl-2">{{ $opcion }}</i>
            </label>
        @endforeach
    </div>
</div>
