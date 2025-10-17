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

        // Массив с точками из Blade-шаблона
        const locations = @json($points);

        // Добавляем метки на карту
        locations.forEach(location => {
            const coords = JSON.parse(location.location); // Декодируем JSON из базы
            const popupContent = `ФИО: ${location.fullName}<br>Телефон: ${location.phone}<br>Описание: ${location.description}`;

            L.marker([coords.latitude, coords.longitude]).addTo(map).bindPopup(popupContent);
        });
    </script>
@endpush


