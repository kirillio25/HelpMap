<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карта с отметкой</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>

<header data-bs-theme="dark">
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 1 2 0-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Album</strong>
            </a>

            <div class="text-end">
                <a href="#" class="btn btn-warning">
                    Нужна помощь
                </a>
            </div>

{{--            @if (Route::has('login'))--}}
{{--                <nav class="-mx-3 flex flex-1 justify-end">--}}
{{--                    @auth--}}
{{--                        <a--}}
{{--                            href="{{ url('/dashboard') }}"--}}
{{--                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                        >--}}
{{--                            Dashboard--}}
{{--                        </a>--}}
{{--                    @else--}}
{{--                        <a--}}
{{--                            href="{{ route('login') }}"--}}
{{--                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                        >--}}
{{--                            Log in--}}
{{--                        </a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a--}}
{{--                                href="{{ route('register') }}"--}}
{{--                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                            >--}}
{{--                                Register--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </nav>--}}
{{--            @endif--}}


        </div>
    </div>
</header>

<main>
    <div id="map"></div>
    <p class="text-center">Координаты: <span id="coordinates">Нажмите на карту</span></p>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    const map = L.map('map').setView([55.7558, 37.6173], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
    }).addTo(map);

    let userMarker;

    map.on('click', function (e) {
        const { lat, lng } = e.latlng;

        if (userMarker) {
            userMarker.setLatLng([lat, lng]);
        } else {
            userMarker = L.marker([lat, lng]).addTo(map);
        }

        document.getElementById('coordinates').textContent = `Широта: ${lat.toFixed(6)}, Долгота: ${lng.toFixed(6)}`;
    });
</script>

</body>
</html>
