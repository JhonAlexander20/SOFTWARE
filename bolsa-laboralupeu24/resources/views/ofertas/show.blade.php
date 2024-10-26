<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-gradient-to-br from-green-100 to-gray-50 shadow-lg sm:rounded-lg p-6 transition-all duration-300 hover:shadow-2xl">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-6 flex items-center">
                <svg class="w-8 h-8 text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                </svg>
                {{ $oferta->titulo }}
            </h1>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4 flex items-center animate-bounce">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Mensaje de alerta si ya está postulado -->
            @if (session('alert'))
                <div class="bg-red-500 text-white p-4 rounded mb-4 flex items-center">
                    <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('alert') }}</span>
                </div>
            @endif

            <!-- Detalles de la oferta en vertical -->
            <div class="flex flex-col mb-6 space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-800 text-lg">Descripción:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->descripcion }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-800 text-lg">Salario:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->salario }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-800 text-lg">Ubicación:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->ubicacion }}</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition-all duration-200">
                    <strong class="text-gray-800 text-lg">Fecha de Vencimiento:</strong>
                    <p class="text-gray-600 mt-2">{{ $oferta->fecha_vencimiento }}</p>
                </div>
            </div>

            <!-- Botón de Postularse (visible solo para postulantes) -->
            @role('postulante')
            <div class="flex justify-center mb-4">
                <button onclick="mostrarModal()" class="bg-green-600 text-white px-8 py-3 rounded-full hover:bg-green-700 transition-all duration-300 ease-in-out flex items-center transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Postularse
                </button>
            </div>
            @endrole

            <div class="flex justify-end mt-8">
                <a href="{{ route('ofertas.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-full hover:bg-gray-700 transition-all duration-300 ease-in-out flex items-center transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0v6m0-6V6" />
                    </svg>
                    Regresar
                </a>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación -->
    <div id="confirmModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Confirmación de Postulación</h2>
            <p class="text-gray-600 mb-6">¿Estás seguro de que deseas postularte a esta oferta?</p>
            <div class="flex justify-end space-x-4">
                <button onclick="ocultarModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-600 transition-all">Cancelar</button>
                <form id="postulacionForm" action="{{ route('postularse', $oferta->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-all">Confirmar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts para controlar el modal -->
    <script>
        function mostrarModal() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function ocultarModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
