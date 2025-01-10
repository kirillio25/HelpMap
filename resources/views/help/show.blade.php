@extends('layouts.app')
@section('title', 'Просмотр метки')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Просмотр метки: {{ $point->fullName }}</h3>
            </div>
            <div class="card-body">
                <!-- Карта с точкой -->
                <div id="map"></div>

                <!-- Кнопка назад -->
                <a href="{{ route('help-dashboard.index') }}" class="btn btn-dark">Назад</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const location = @json($location);

        const map = L.map('map').setView([location.latitude, location.longitude], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([location.latitude, location.longitude]).addTo(map);
    </script>
@endpush
