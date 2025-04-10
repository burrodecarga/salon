<x-layouts.app :title="__('Crear módulo')">

    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __($title) }}</strong></h1>
            <hr>
            <form action="{{ route('base.almacenar', $question) }}" method="POST">
                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">
                @include('base.partials.form')
            </form>
        </div>
    </div>
    </x-app-layout>
