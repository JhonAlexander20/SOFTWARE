<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Usuarios Pendientes de Aprobación') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-blue-200 to-indigo-300 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 lg:p-8">
                <!-- Lista de usuarios pendientes -->
                <div class="flex flex-wrap justify-center gap-8">
                    @foreach($users as $user)
                    <div class="bg-white border border-gray-300 shadow-lg rounded-lg p-4 flex flex-col items-center w-1/4 hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                        <!-- Información del usuario -->
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            <p class="text-sm text-indigo-500 mt-1">{{ ucfirst($user->rol) }}</p>
                        </div>

                        <!-- Botón para aprobar usuario -->
                        <div class="flex mt-4 justify-center">
                            <form action="{{ route('usuarios.approve', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition-transform duration-200 ease-in-out transform hover:scale-105">
                                    Aprobar
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Enlaces de paginación -->
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
