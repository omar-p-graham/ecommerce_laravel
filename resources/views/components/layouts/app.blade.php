<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Omar P Graham">
        <meta name="linkedin" content="https://www.linkedin.com/in/omar-p-graham">
        <meta name="github" content="https://www.github.com/omar-p-graham">
        <link rel="shortcut icon" href="/images/logo-icon.png" type="image/x-icon">
        <title>{{ $title ?? 'Flex E-Store' }}</title>
        @vite('resources/css/app.css','resources/js/app.js')
        @livewireStyles
    </head>
    <body class="flex flex-col min-h-screen bg-light dark:bg-darkest text-darkest dark:text-lightest">
        @livewire('partials.navbar')
        <main class="flex-grow w-full">
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-livewire-alert::scripts />
    </body>
</html>
