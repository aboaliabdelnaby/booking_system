<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Admin' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.home') }}" wire:navigate>
                {{  'Admin' }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest('admin')
                        @if (Route::has('admin.login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::guard('admin')->user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @can('admin.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}" wire:navigate>{{ 'Admins' }}</a>
                        </li>
                        @endcan
                        @can('admin.room.index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.room.index') }}" wire:navigate>{{ 'Rooms' }}</a>
                            </li>
                        @endcan
                        @can('admin.request.index')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.request.index') }}" wire:navigate>{{ 'Requests' }}</a>
                            </li>
                        @endcan
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        {{ $slot }}
    </main>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('livewire-events.js')}}"></script>
<script>
    $(function () {
        @if(session()->has('success'))
        Livewire.dispatch('success', '{{session()->get('success')}}');
        @php(session()->forget('success'))
        @endif

        @if(session()->has('error'))
        Livewire.dispatch('error', '{{session()->get('error')}}');
        @php(session()->forget('error'))
        @endif
    })
</script>
</body>
</html>
