<x-layouts.app :title="'preguntas de exámen'">
    <h1>{{ $examen->asignatura }}</h1>
    <h1>{{ $examen->teacher?->name }}</h1>
    <h1>{{ $examen->name }}</h1>
    <h2>preguntas {{ $questions->count() }}</h2>
    <h1>{{ $examen->level }}</h1>
    <h1>{{ $examen->type }}</h1>
    <a href="{{ route('examenes.add_pregunta', $examen->id) }}" title="Agregar preguntas a Exámen"
        class="text-white my-0.5 text-[14px] px-4 py-2 bg-green-500 hover:bg-blue-500">Agregar
        Preguntas</a>
    @foreach ($questions as $key => $question)
        <article class="bg-gray-200 my-6 p-4 rounded">
            <section>
                <p>{{ $key + 1 . ' .- ' . $question->question . '---' . $question->id }}
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
    @if ($questions->count() > 0)
        <div>
            {{ $questions->links() }}
        </div>
    @endif
</x-layouts.app>
