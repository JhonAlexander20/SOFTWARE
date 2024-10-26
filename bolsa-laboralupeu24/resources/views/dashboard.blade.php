<x-app-layout>
    <div class="min-h-screen bg-gradient-to-r from-blue-600 via-purple-700 to-pink-600 py-10">
        <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">

            <!-- Encabezado general para todos los roles -->
            <div class="bg-gradient-to-r from-purple-800 to-pink-800 py-12 text-center text-white">
                <h1 class="text-6xl font-extrabold">!Bienvenido a tu nuevo futuro!</h1>
                <p class="mt-4 text-xl font-medium">Gestiona tus opciones de manera eficiente según tu rol.</p>
                <p class="mt-2 text-lg opacity-80">Una experiencia personalizada y profesional te espera.</p>
            </div>

            <!-- Contenido específico por roles -->
            <div class="px-10 py-8">
                @role('empresa')
                    <!-- Vista para Empresas -->
                    <div class="text-center mb-10">
                        <h2 class="text-4xl font-bold text-gray-800 mb-4">Panel de la Empresa</h2>
                        <p class="text-lg text-gray-600 mb-8">Gestiona tus ofertas de empleo y revisa las postulaciones con facilidad y eficacia.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Gráfica de estadísticas -->
                        <div class="bg-white p-8 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Estadísticas de Ofertas</h3>
                            <div class="relative">
                                <canvas id="offersChart" width="400" height="400"></canvas>
                            </div>
                        </div>

                        <!-- Sección de consejos para empresas -->
                        <div class="bg-yellow-100 p-8 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                            <h3 class="text-xl font-bold text-gray-800 mb-6">Consejos para Publicar Ofertas</h3>
                            <p class="text-gray-600 mt-2">Asegúrate de que tus ofertas sean claras y atractivas. Considera incluir beneficios y oportunidades de desarrollo profesional para atraer a los mejores talentos.</p>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-center">
                        <a href="{{ route('ofertas.index') }}" class="bg-blue-600 text-white px-8 py-4 rounded-full shadow-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300">
                            Ver Mis Ofertas
                        </a>
                    </div>
                @endrole
            </div>
        </div>
    </div>

    <!-- Script para la gráfica -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('offersChart').getContext('2d');
        const offersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ofertas Publicadas', 'Postulaciones Recibidas', 'Empresas Conectadas'],
                datasets: [{
                    label: '# de Ofertas',
                    data: [12, 19, 5], // Cambia estos valores según sea necesario
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(153, 102, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
