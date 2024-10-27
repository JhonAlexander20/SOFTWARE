<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-r from-blue-500 via-teal-400 to-green-500 p-8 shadow-lg rounded-lg text-white">
            <h1 class="text-4xl font-extrabold mb-8 text-center">Ofertas de Trabajo</h1>

            @role('empresa|admin')
            <div class="flex justify-center mb-6">
                <a href="{{ route('ofertas.create') }}" class="bg-white text-blue-700 font-semibold px-6 py-3 rounded-full shadow-lg hover:bg-gray-200 transition-all duration-300 ease-in-out flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Crear Nueva Oferta
                </a>
            </div>
            @endrole

            @if (session('success'))
                <div class="bg-white text-green-600 p-4 rounded-lg shadow-lg mb-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="space-y-6">
                @foreach($ofertas as $oferta)
                    @php
                        $hoy = now()->toDateString();
                        $esVencida = $oferta->fecha_vencimiento < $hoy;
                    @endphp
                    <div class="flex items-center bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 ease-in-out hover:scale-105">
                        <div class="p-6 flex-1">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $oferta->titulo }}</h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($oferta->descripcion, 100) }}</p>
                            <p class="text-gray-600 mt-2"><strong>Salario:</strong> {{ $oferta->salario }} USD</p>
                            <p class="text-gray-600 mt-2"><strong>Ubicación:</strong> {{ $oferta->ubicacion }}</p>
                            <p class="text-gray-600 mt-2">
                                <strong>Fecha de Vencimiento:</strong> {{ $oferta->fecha_vencimiento }}
                                @if($esVencida)
                                    <span class="text-red-600 font-bold ml-2">Oferta Vencida</span>
                                @else
                                    <span class="text-green-600 font-bold ml-2">Vigente</span>
                                @endif
                            </p>
                        </div>
                        <div class="p-6 bg-gray-50 flex flex-col space-y-3">
                            <a href="{{ route('ofertas.show', $oferta->id) }}" class="bg-teal-500 text-white px-4 py-2 rounded-full text-center hover:bg-teal-600 transition-all duration-300">Ver Detalles</a>

                            @role('empresa|admin')
                                <a href="{{ route('ofertas.edit', $oferta->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-full text-center hover:bg-yellow-600 transition-all duration-300">Editar</a>

                                <form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" onsubmit="return showDeleteConfirmation(event, '{{ $oferta->titulo }}', '{{ route('ofertas.destroy', $oferta->id) }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full text-center hover:bg-red-600 transition-all duration-300">Eliminar</button>
                                </form>
                            @endrole
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal de Confirmación -->
        <div id="confirmationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-6 shadow-lg text-center w-96">
                <h2 class="text-xl font-bold mb-4" id="confirmationTitle">Confirmar Acción</h2>
                <p id="confirmationMessage" class="text-gray-700 mb-4">¿Estás seguro que deseas proceder?</p>
                <div class="mt-4 flex justify-around">
                    <button id="confirmButton" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition-all duration-300">Confirmar</button>
                    <button id="cancelButton" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition-all duration-300">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteConfirmation(event, title, action) {
            event.preventDefault(); // Evita el envío del formulario
            const modal = document.getElementById('confirmationModal');
            const titleElement = document.getElementById('confirmationTitle');
            const messageElement = document.getElementById('confirmationMessage');
            const confirmButton = document.getElementById('confirmButton');

            titleElement.innerText = 'Eliminar Oferta';
            messageElement.innerText = `¿Estás seguro que deseas eliminar la oferta "${title}"?`;
            modal.classList.remove('hidden');

            confirmButton.onclick = function() {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = action;

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = '{{ csrf_token() }}';
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            };

            document.getElementById('cancelButton').onclick = function() {
                modal.classList.add('hidden');
            };
        }
    </script>
</x-app-layout>
