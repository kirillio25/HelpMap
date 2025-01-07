@extends('layouts.app')
@section('title', 'Welcome Page')

@push('styles')
    <style>
        #map {
            height: 100vh;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

<body>
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


@section('content')
    <div id="map"></div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Создаём карту с центром в Москве
        const map = L.map('map').setView([55.7558, 37.6173], 5);

        // Подключаем слой карты OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
        }).addTo(map);

        // Предустановленные метки с координатами
        const locations = [
            { coords: [55.7558, 37.6173], popup: "Москва, Россия" },
            { coords: [59.9343, 30.3351], popup: "Санкт-Петербург, Россия" },
            { coords: [48.8566, 2.3522], popup: "Париж, Франция" },
            { coords: [51.5074, -0.1278], popup: "Лондон, Великобритания" },
            { coords: [40.7128, -74.0060], popup: "Нью-Йорк, США" }
        ];

        // Добавляем метки на карту
        locations.forEach(location => {
            L.marker(location.coords).addTo(map).bindPopup(location.popup);
        });
    </script>
@endpush

