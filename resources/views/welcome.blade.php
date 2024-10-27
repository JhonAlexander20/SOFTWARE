<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .navbar {
            background-color: #f8f9fa;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .hero {
            position: relative;
            height: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
            padding: 0 40px;
        }

        .stat-card {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 15px;
        }

        .stat-card p {
            font-size: 18px;
            color: #333;
        }

        .footer {
            background-color: #1f2937;
            color: white;
            padding: 40px 0;
            text-align: center;
            font-family: 'Poppins', sans-serif;
        }

        .footer p {
            margin-bottom: 20px;
            font-size: 16px;
        }

        .social-icons a {
            margin: 0 10px;
            display: inline-block;
            color: white;
            font-size: 24px;
        }

    </style>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="navbar py-4 px-10 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-indigo-600">Universidad Peruana Union</h1>
        </div>
        <div class="flex space-x-6">
            <a href="#" class="text-gray-700 hover:text-indigo-600">Buscar empleos</a>
            <a href="#" class="text-gray-700 hover:text-indigo-600">Empresas</a>
            <a href="#" class="text-gray-700 hover:text-indigo-600">Salarios</a>
            <a href="#" class="text-gray-700 hover:text-indigo-600">Carreras</a>
        </div>
        <div>
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 mr-4">INICIAR SESIÓN</a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-indigo-600">REGISTRAR</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <video autoplay muted loop>
            <source src="{{ asset('videos/video1.mp4') }}" type="video/mp4">
            Tu navegador no soporta videos HTML5.
        </video>

        <div class="overlay"></div>

        <div class="hero-content">
            <h1 class="text-5xl font-bold mb-6">Cambia tu entorno de vida</h1>
            <p class="mb-6 text-2xl">Transforma tu carrera con más de <span class="font-bold">47,255</span> empleos disponibles</p>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="bg-white py-16">
        <div class="text-center mb-10">
            <p class="text-lg font-semibold text-gray-800">Datos clave sobre el mercado laboral</p>
        </div>
        <div class="stats">
            <div class="stat-card">
                <h3>+47,255</h3>
                <p>Empleos disponibles</p>
            </div>
            <div class="stat-card">
                <h3>9,080</h3>
                <p>Empresas que te buscan</p>
            </div>
            <div class="stat-card">
                <h3>+5,000</h3>
                <p>Carreras destacadas</p>
            </div>
        </div>
    </section>

  <!-- Empresa Section -->
<section class="bg-white py-10">
    <div class="text-center">
        <p class="text-lg font-semibold text-gray-800">Empresas que confían en nosotros</p>
    </div>
    <div class="company-logos flex justify-center space-x-4 mt-6">
        <img src="{{ asset('imgs/logo1.png') }}" alt="logo" class="h-16">
        <img src="{{ asset('imgs/logo2.png') }}" alt="logo" class="h-16">
        <img src="{{ asset('imgs/logo3.png') }}" alt="logo" class="h-16">
        
    </div>
</section>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2024 Upeu Jobs. Todos los derechos reservados.</p>
        <p>Contáctanos:</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-whatsapp"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
