<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .content {
            flex: 1;
        }
    </style>
    <title>@yield('title', 'Мой сайт')</title>
    @stack('styles')
</head>
<body>
<!-- Header -->
<header data-bs-theme="dark">
    @include('layouts.navigation')
</header>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<footer class="text-body-secondary py-5 mt-auto">
    <div class="container">
        <div class="row">
            <!-- Описание проекта -->
            <div class="col-12 text-center mb-3">
                <p class="h5 mb-1">
                    Этот проект создан для помощи людям.
                </p>
                <p class="lead mb-3">
                    Здесь вы можете оставить заявку, указав, что вам необходимо, и отметить ваше месторасположение на карте.
                </p>
            </div>

            <!-- Информация о проекте -->
            <div class="col-12 text-center">
                <p class="mb-0">
                    С помощью этой платформы вы сможете легко управлять точками на карте, просматривать их расположение и редактировать информацию.
                </p>
            </div>

        </div>
    </div>
</footer>



<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{--для dropdown--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@stack('scripts')
</body>
</html>
