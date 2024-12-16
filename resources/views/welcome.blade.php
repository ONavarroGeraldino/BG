<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Big Data - Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #1d4ed8;
            margin-bottom: 0.5rem;
        }

        .section-content {
            font-size: 1rem;
            line-height: 1.5rem;
            color: #374151;
        }

        .content-section {
            display: flex;
            flex-wrap: nowrap;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 2rem;
            padding: 1rem 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .content-section img {
            width: 120px;
            height: auto;
            flex-shrink: 0;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-section .text-content {
            flex: 1;
        }

        .bg-header {
            background: linear-gradient(90deg, #1e293b, #2563eb);
            color: white;
            text-align: center;
            padding: 2rem 1rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body class="antialiased font-sans bg-gray-50">
    <header class="w-full bg-gray-100 shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center text-lg font-semibold text-blue-600 hover:underline">
                <div class="w-8 h-8 flex items-center justify-center bg-black rounded-full">
                    <div class="w-4 h-4 bg-white rounded-full"></div>
                </div>
                <span class="ml-2">Inicio</span>
            </a>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-lg font-semibold text-blue-600 hover:underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-lg font-semibold text-blue-600 hover:underline">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-lg font-semibold text-blue-600 hover:underline">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </header>

    <main class="py-10 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="bg-header">
                <h1 class="text-4xl font-extrabold">Big Data</h1>
                <p class="text-xl mt-4">Explora el mundo del Big Data y cómo transforma industrias a nivel global.</p>
            </div>

            <section class="mt-10">
                <div class="content-section">
                    <img src="https://daxg39y63pxwu.cloudfront.net/images/blog/learn-big-data/Introduction_to_Big_Data.png" alt="Introducción al Big Data">
                    <div class="text-content">
                        <h2 class="section-title">¿Qué es Big Data?</h2>
                        <p class="section-content">
                            Big Data se refiere al análisis y manejo de grandes volúmenes de datos que no pueden ser procesados 
                            de manera eficiente con herramientas tradicionales. Su objetivo es identificar patrones, tendencias y 
                            obtener insights valiosos.
                        </p>
                    </div>
                </div>
            </section>

            <section class="mt-8">
                <div class="content-section">
                    <img src="https://www.eventrebels.com/wp-content/uploads/2015/01/bigstock-Big-data-concept-in-word-tag-c-49922318.jpg" alt="Conceptos de Big Data">
                    <div class="text-content">
                        <h2 class="section-title">Importancia del Big Data</h2>
                        <p class="section-content">
                            En sectores como la salud, los negocios y la educación, el Big Data permite tomar decisiones informadas, 
                            mejorar procesos y ofrecer soluciones innovadoras. Su impacto sigue creciendo a medida que la tecnología 
                            avanza.
                        </p>
                    </div>
                </div>
            </section>

            <section class="mt-8">
                <div class="content-section">
                    <img src="https://th.bing.com/th/id/R.987e4bd9e2b7b1f6cdd0fe12503f7570?rik=wkVp8uTaYDc%2fiQ&riu=http%3a%2f%2fwww.painsupport.org%2fwp-content%2fuploads%2f2016%2f01%2fBig-Data.png&ehk=ITQtimiymmlA13IvjeZsC5jAelQ%2fZF4U4RSqNWhdOi4%3d&risl=&pid=ImgRaw&r=0" alt="Aplicaciones del Big Data">
                    <div class="text-content">
                        <h2 class="section-title">Conclusión</h2>
                        <p class="section-content">
                            Adoptar Big Data no solo significa adaptarse a los tiempos modernos, sino también aprovechar al máximo 
                            el poder de la información para generar un impacto positivo y sostenible.
                        </p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
