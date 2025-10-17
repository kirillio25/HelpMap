@extends('layouts.app')
@section('title', 'Редактирование метки')

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

<body>

@section('content')

    <div class="container my-5">
        <div class="card">
            <div class="card-header text-center">
                <h3>Редактирование метки</h3>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Измените своё местоположение на карте:</h5>
                <div id="map"></div>

                <form id="editDataForm" method="POST" action="{{ route('help-dashboard.update', $point->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- ФИО -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">ФИО</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" value="{{ $point->fullName }}" required>
                    </div>

                    <!-- Телефон -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $point->phone }}" required>
                    </div>

                    <!-- Описание -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $point->description }}</textarea>
                    </div>

                    <!-- Местоположение (скрытое поле) -->
                    <input type="hidden" id="location" name="location" value="{{ $point->location }}">

                    <button type="submit" class="btn btn-dark w-100">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Инициализируем карту с сохранёнными координатами
        const locationData = @json(json_decode($point->location));  // Преобразуем JSON строку в объект

        const map = L.map('map').setView([locationData.latitude, locationData.longitude], 12);

        // Подключаем слой карты OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Устанавливаем маркер на сохранённые координаты
        let marker = L.marker([locationData.latitude, locationData.longitude]).addTo(map);

        // Добавляем обработчик кликов по карте
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            // Удаляем предыдущий маркер
            if (marker) {
                map.removeLayer(marker);
            }

            // Добавляем новый маркер
            marker = L.marker([lat, lng]).addTo(map);

            // Обновляем скрытое поле с местоположением
            document.getElementById('location').value = JSON.stringify({ latitude: lat, longitude: lng });
        });
    </script>

@endpush
