@extends('layouts.app')
@section('title', 'Welcome Page')
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
                <h3>Добавление метки на карте</h3>
            </div>
            <div class="card-body">
                <h5 class="mb-3">Отметьте своё местоположение на карте:</h5>
                <div id="map"></div>

                <form id="addDataForm" method="POST" action="{{ route('help-dashboard.store') }}">
                    @csrf
                    <!-- ФИО -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">ФИО</label>
                        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Введите ФИО" required>
                    </div>

                    <!-- Телефон -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Введите телефон" required>
                    </div>

                    <!-- Описание -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Введите описание"></textarea>
                    </div>

                    <!-- Местоположение (скрытое поле) -->
                    <input type="hidden" id="location" name="location">

                    <button type="submit" class="btn btn-dark w-100">Добавить</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Создаём карту с начальной позицией и масштабом
        const map = L.map('map').setView([53.2192, 63.6340], 12);

        // Подключаем слой карты OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Добавляем обработчик кликов по карте
        let marker;
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;

            // Удаляем предыдущий маркер, если он есть
            if (marker) {
                map.removeLayer(marker);
            }

            // Добавляем новый маркер
            marker = L.marker([lat, lng]).addTo(map);

            // Обновляем скрытое поле с местоположением
            document.getElementById('location').value = `${lat}, ${lng}`;

            // Проверка значений
            console.log(`Location set to: ${lat}, ${lng}`);
        });

        // Добавляем проверку перед отправкой формы
        document.getElementById('addDataForm').addEventListener('submit', function (e) {
            const location = document.getElementById('location').value;

            // Если местоположение не выбрано, показываем ошибку и не отправляем форму
            if (!location || location === '') {
                e.preventDefault();  // Отменяем отправку формы
                alert('Пожалуйста, отметьте местоположение на карте.');
            } else {
                console.log('Форма отправляется с местоположением:', location);
            }
        });
    </script>
@endpush
