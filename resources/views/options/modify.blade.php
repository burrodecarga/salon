<x-layouts.app :title="__('Modificar Opción')">

    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __($title) }}</strong></h1>
            <hr>
            <form action="{{ route('options.actualiza', [$option]) }}" method="POST">
                @method('POST')

                @include('options.partials.form1')
            </form>
        </div>
    </div>
    </x-app-layout>
