<x-layouts.app :title="__('Crear módulo')">

    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __($title) }}</strong></h1>
            <hr>
            <form action="{{ route('base.almacenar', $question) }}" method="POST">
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                <input type="hidden" name="modulo_id" value="{{ $modulo->id }}">
                <input type="hidden" name="asignatura_id" value="{{ $asignatura->id }}">
                <input type="hidden" name="lesson" value="{{ $lesson->name }}">
                <input type="hidden" name="modulo" value="{{ $modulo->name }}">
                <input type="hidden" name="asignatura" value="{{ $asignatura->name }}">
                @include('base.partials.form')
            </form>
        </div>
    </div>
    </x-app-layout>
