<x-layouts.app :title="__('Crear Sección o Aula')">

    <div class="w-1/2 mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __($title) }}</strong></h1>
            <hr>
            <form action="{{ route('aulas.store', $aula->id) }}" method="POST">

                @include('aulas.partials.form')
            </form>
        </div>
    </div>
    </x-app-layout>
