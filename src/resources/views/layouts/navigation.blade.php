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
            <!-- Проверка, авторизован ли пользователь -->
            @if (auth()->check())
                <!-- Панель с навигацией для авторизованных пользователей -->
                <div class="navbar navbar-dark bg-dark shadow-sm">
                    <div class="container">
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small">
{{--                                <li><a class="dropdown-item" href="#">New project...</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">Settings</a></li>--}}
{{--                                <li><a class="dropdown-item" href="#">Profile</a></li>--}}
{{--                                <li><hr class="dropdown-divider"></li>--}}
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            {{ __('Выйти') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            @else
                <!-- Кнопка "Нужна помощь" для неавторизованных пользователей -->
                <div class="text-end">
                    <a href="{{ route('login') }}" class="btn btn-warning">Нужна помощь</a>
                </div>
            @endif

        </div>
    </div>
</div>


