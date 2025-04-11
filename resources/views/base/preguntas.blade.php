<x-layouts.app :title="__('Preguntas de Lección')">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            @include('nav.inicio')
            @include('nav.asignaturas')
            {{-- @include('nav.asignatura') --}}
            {{-- @include('nav.modulos') --}}
            {{-- @include('nav.leccion') --}}
        </ol>
    </nav>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex"><span class="font-bold text-2xl">Modulo:
            </span> <span> {{ $modulo->name }}</span> </div>
        <div class="grid  gap-4 grid-cols-1">
            <div class="border px-4 py-2 bg-gray-100 rounded justify-between flex"><span class="font-bold text-2xl">
                    Lección: </span> <span> {{ $lesson->name }}</span><a
                    href="{{ route('base.pregunta', [$modulo->id, $lesson->id]) }}"
                    class="px-4 py-2 bg-gray-300 font-bold">Crear Preguntas de Lección</a> </div>

            <div class="border px-4 py-2 bg-white rounded justify-between flex items-center text-center mx-auto"><span
                    class="font-bold text-2xl text-center">Preguntas de la Lección</span></div>


            <div class="border px-4 py-2 bg-gray-100 rounded"><span class="font-bold text-2xl"> Preguntas: </span>
                <div class="w-full bg-gray-100">
                    @foreach ($questions as $key => $question)
                        <div class="flex justify-between items-center gap-10 my-2 bg-white border p-6">
                            <span class="font-bold text-gray-700">{{ $key + 1 }}.</span>
                            <span class="flex-1/3">{{ $question->question }}</span>
                            <span class="flex-1">{{ $question->level }}</span>
                            <div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div x-data="{
                                open: false,
                                toggle() {
                                    if (this.open) {
                                        return this.close()
                                    }
                            
                                    this.$refs.button.focus()
                            
                                    this.open = true
                                },
                                close(focusAfter) {
                                    if (!this.open) return
                            
                                    this.open = false
                            
                                    focusAfter && focusAfter.focus()
                                }
                            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                                x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                                x-id="['dropdown-button']" class="relative">
                                <!-- Button -->
                                <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                                    :aria-controls="$id('dropdown-button')" type="button"
                                    class="relative flex items-center whitespace-nowrap justify-center gap-2 py-2 rounded-lg shadow-sm bg-white hover:bg-gray-50 text-gray-800 border border-gray-200 hover:border-gray-200 px-4">
                                    <span>Opciones de Respuesta</span><span>{{ $question->options()->count() }}</span>

                                    <!-- Heroicon: micro chevron-down -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="size-4">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Panel -->
                                <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                    x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')" x-cloak
                                    class="min-w-48 rounded-lg shadow-sm mt-2 z-10 bg-white p-1.5 outline-none border border-gray-200">
                                    @foreach ($question->options as $option)
                                        <div class="flex justify-between gap-6 items-center border bg-white p-4">
                                            <p class="flex-1/3">{{ $option->answer }}</p>
                                            <p class="">
                                                @if ($option->is_true)
                                                    Respuesta Correcta
                                                @else
                                                    Respuesta Incorrecta
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($questions->count() > 0)
                    {{ $questions->links() }}
                @endif
            </div>


        </div>
    </div>
</x-layouts.app>
