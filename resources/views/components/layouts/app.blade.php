<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Omar P Graham">
        <meta name="linkedin" content="https://www.linkedin.com/in/omar-p-graham">
        <meta name="github" content="https://www.github.com/omar-p-graham">
        <title>{{ $title ?? 'Flex E-Store' }}</title>
        @vite('resources/css/app.css','resources/js/app.js')
        @livewireStyles
    </head>
    <body class="bg-slate-200 dark:bg-gray-800">
        @livewire('partials.navbar')
        <main class="w-full">
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
    </body>
</html>
