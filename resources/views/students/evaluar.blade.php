<x-layouts.app.test :title="'Evaluación'">
    <h1>{{ $examen->asignatura }}</h1>
    <h1>{{ $examen->teacher->name }}</h1>
    <h1>{{ $examen->name }}</h1>


    <form action="{{ route('students.evaluacion') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <input type="hidden" name="examen_id" value="{{ $examen->id }}">
        @foreach ($questions as $key => $question)
            <article class="bg-gray-200 my-6 p-4 rounded">
                <section>
                    {{-- <p>{{ ($questions->currentPage() - 1) * $perPage + $key + 1 . ' .- ' . $question->question }} --}}
                    </p>
                    <ul class="ml-4 my-2">
                        @foreach ($question->options()->inRandomOrder()->get() as $o => $option)
                            <li class="text-[14px] my-2">
                                <input type="radio" name="p-{{ $question->id }}" id="{{ $question->id }}"
                                    value="r-{{ $option->id }}" />
                                <label for="{{ $question->id }}">{{ $option->answer }}</label>
                            </li>
                        @endforeach
                    </ul>
                </section>

            </article>
        @endforeach
        {{-- @if ($examen->questions->count() > 0)
            <div>
                {{ $questions->links() }}
            </div>
        @endif --}}
        <button type="submit"
            class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            {{ __('ENVIAR') }}

        </button>


    </form>

</x-layouts.app.test>
