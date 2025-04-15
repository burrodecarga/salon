<x-layouts.app :title="'preguntas de exámen'">
    <h1>{{ $examen->name }}</h1>
    <h2>preguntas {{ $questions->count() }}</h2>
    <h1>{{ $examen->description }}</h1>
    @foreach ($questions as $key => $question)
        <article class="bg-gray-200 my-6 p-4 rounded">
            <section>
                <p>{{ $key + 1 . ' .- ' . $question->question }}
                </p>
                <ul class="ml-4 my-2">
                    @foreach ($question->options()->inRandomOrder()->get() as $o => $option)
                        <li class="text-[14px] my-2"><input type="radio" name="" id="">
                            {{ $option->answer . ' - ' }}{{ $option->is_true ? 'respuesta correcta' : 'respuesta incorrecta' }}
                        </li>
                    @endforeach
                </ul>
            </section>

        </article>
    @endforeach
</x-layouts.app>
