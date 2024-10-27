<x-app-layout>
    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-black min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 shadow-lg rounded-lg p-6">
                <h1 class="text-4xl font-extrabold text-white mb-6 flex items-center">
                    <i class="fas fa-briefcase text-yellow-400 mr-3"></i> Mis Postulaciones
                </h1>

                @if($postulaciones->isEmpty())
                    <div class="bg-red-500 border-l-4 border-red-700 text-white p-4 rounded-lg shadow-lg" role="alert">
                        <p>No te has postulado a ninguna oferta todavía.</p>
                    </div>
                @else
                    <table class="table-auto w-full mt-5 bg-gray-800 rounded-lg shadow-lg text-gray-300">
                        <thead class="bg-gradient-to-r from-red-700 via-purple-700 to-indigo-700 text-white">
                            <tr>
                                <th class="px-4 py-3">Título</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Salario</th>
                                <th class="px-4 py-3">Ubicación</th>
                                <th class="px-4 py-3">Fecha de Vencimiento</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($postulaciones as $postulacion)
                                <tr class="bg-gray-700 hover:bg-gray-600 transition duration-300 ease-in-out">
                                    <td class="border px-4 py-2 text-white font-medium flex items-center">
                                        <i class="fas fa-briefcase mr-2 text-yellow-400"></i> {{ $postulacion->oferta->titulo }}
                                    </td>
                                    <td class="border px-4 py-2">{{ Str::limit($postulacion->oferta->descripcion, 50) }}</td>
                                    <td class="border px-4 py-2">{{ $postulacion->oferta->salario }} USD</td>
                                    <td class="border px-4 py-2">{{ $postulacion->oferta->ubicacion }}</td>
                                    <td class="border px-4 py-2">{{ $postulacion->oferta->fecha_vencimiento }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($postulacion->estado) }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('postulaciones.cancelar', $postulacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta postulación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                                                Cancelar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
