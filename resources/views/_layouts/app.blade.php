<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', '')
        @if(trim($__env->yieldContent('title'))) | @endif {{ config('app.name') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">
<header class="bg-zinc-800 text-white">
    <nav class="container relative flex justify-between gap-8 h-16">
        <div class="flex items-center gap-x-8">
            <a href="{{ route('index') }}" class="text-2xl tracking-tighter font-black leading-tight">
                {{ config('app.name') }}
            </a>
        </div>

        <div class="flex flex-wrap items-center font-medium gap-x-8">
            @if(isset($link))
                <form action="{{ route('link.regenerate', $link->uuid) }}" method="post">
                    @csrf
                    <button type="submit" class="cursor-pointer hover:underline">{{ __('Generate New Link') }}</button>
                </form>

                <form action="{{ route('link.deactivate', $link->uuid) }}" method="post">
                    @csrf
                    <button type="submit" class="cursor-pointer hover:underline">{{ __('Deactivate Link') }}</button>
                </form>
            @endif
        </div>
    </nav>
</header>

<main class="flex flex-col flex-1 py-8">
    @yield('content')
</main>

<footer>
    <div class="container py-4">
        <p class="text-center text-sm">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </p>
    </div>
</footer>

@include('_components.toast-message')

@stack('scripts')
</body>
</html>
