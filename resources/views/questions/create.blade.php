<x-layouts.app :title="__('Crear lección a módulo')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
       @include('nav.inicio')
       @include('nav.asignaturas')
       @include('nav.asignatura')
       @include('nav.modulos')

          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <a href="{{route('modulos.index',[$asignatura,$modulo])}}" class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{$modulo->name}}</a>
            </div>
          </li>
          <li aria-current="page">
            <div class="flex items-center">
              <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
              </svg>
              <a  href="{{route('lessons.index',[$asignatura,$modulo])}}"   class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Lecciones</a>
            </div>
          </li>
        </li>
        <li aria-current="page">
          <div class="flex items-center">
            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span     class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Crear Lección</span>
          </div>
        </li>

        </ol>
      </nav>
    <div class="w-full mx-auto bg-gray-300 rounded shadow-lg">
        <div class="w-full p-6 mx-auto my-10">
            <h1 class="text-2xl font-bold capitalize"><strong>{{ __($title) }}</strong></h1>
            <hr>
            <form action="{{ route('lessons.store',[$asignatura,$modulo]) }}" method="POST">

                @include('lessons.partials.form')
            </form>
        </div>
    </div>
</x-app-layout>
