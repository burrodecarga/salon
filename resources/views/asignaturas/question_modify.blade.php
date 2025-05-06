<x-layouts.app :title="__('Modificar Pregunta')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            @include('nav.asignatura')
            @include('nav.modulos')

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('modulos.index', [$asignatura, $modulo]) }}"
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $modulo->name }}</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('lessons.index', [$asignatura, $modulo]) }}"
                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Lecciones</a>
                </div>
            </li>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Modificar
                        Lección</span>
                </div>
            </li>

        </ol>
    </nav>
    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __('Modifica Pregunta') }}</strong></h1>
            <hr>
            <form action="{{ route('asignaturas.question.actualiza', [$lesson, $question]) }}" method="POST">
                @method('POST')
                @csrf

                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <div class="mb-4">
                    <x-label class="italic my-2 capitalize" value="{{ __('type of answer') }}" for="level" />
                    <select name="type">
                        <option value="multiple" @if ($question->type == 'multiple') selected @endif>selección múltiple
                        </option>
                        <option value="simple" @if ($question->type == 'simple') selected @endif>selección simple
                        </option>
                    </select>
                    <x-input-error for="type" />
                </div>

                <div class="mb-4">
                    <x-label class="italic my-2 capitalize" value="{{ __('level of answer') }}" for="level" />
                    <select name="level">
                        <option value="dificultad baja" @if ($question->level == 'dificultad baja') selected @endif>dificultad
                            baja</option>
                        <option value="dificultad baja-media" @if ($question->level == 'dificultad baja-media') selected @endif>
                            dificultad baja-media
                        </option>
                        <option value="dificultad media" @if ($question->level == 'dificultad media') selected @endif>dificultad
                            media</option>
                        <option value="dificultad media-alta" @if ($question->level == 'dificultad media-alta') selected @endif>
                            dificultad media-alta
                        </option>
                        <option value="dificultad alta" @if ($question->level == 'dificultad alta') selected @endif>dificultad
                            alta</option>
                    </select>
                    <x-input-error for="level" />
                </div>




                <div class="mb-4">
                    <x-label class="italic my-2 capitalize" value="{{ __('question of lesson') }}" for="question" />
                    <x-input required type="text" name="question" class="w-full"
                        placeholder="{{ __('input name of lesson') }}" value="{{ old('name', $lesson->name) }}" />
                    <x-input-error for="question" />
                </div>

                <div class="mb-4">
                    <x-label class="italic my-2 capitalize" value="{{ __('answer of question') }}" for="correct" />
                    <x-input required type="text" name="correct" class="w-full"
                        placeholder="{{ __('input name of lesson') }}" value="{{ old('name', $lesson->name) }}" />
                    <x-input-error for="correct" />
                </div>


                <div class="mb-4">
                    <x-label class="italic my-2 capitalize" value="{{ __('explain') }}" for="explain" />
                    <x-input required type="text" name="explain" class="w-full"
                        placeholder="{{ __('input name of lesson') }}" value="{{ old('name', $lesson->name) }}" />
                    <x-input-error for="explain" />
                </div>




                <button type="submit"
                    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    {{ __('Modificar Pregunta') }}

                </button>

                <a type="button" href="{{ route('lessons.index', [$asignatura, $modulo, $lesson]) }}"
                    class="bg-yellow-700 text-white hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    {{ __('cancel') }}

                </a>



            </form>
        </div>
    </div>
    </x-app-layout>
