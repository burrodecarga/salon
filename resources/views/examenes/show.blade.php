<x-layouts.app :title="'preguntas de exámen'">
    <h1 class="text-2xl text-center">Preguntas de Exámen</h1>
    <div class="flex flex-col gap-1">
        <p class="text-[14px] font-semibold uppercase">{{ $examen->asignatura }}</p>
        <p class="text-[14px] font-semibold uppercase">{{ $examen->teacher?->name }}</p>
        <p class="text-[14px] font-semibold uppercase">{{ $examen->name }}</p>
        <p class="text-[14px]  uppercase"2>preguntas : {{ $questions->count() }}</p>
        <p class="text-[14px]  uppercase">{{ $examen->level }}</p>
        <p class="text-[14px]  uppercase">{{ $examen->type }}</p>
        <a href="{{ route('examenes.add_pregunta', $examen->id) }}" title="Agregar preguntas a Exámen"
            class="text-white my-0.5 text-[14px] px-4 py-2 bg-green-500 hover:bg-blue-500">Agregar
            Preguntas</a>
    </div>
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
