<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('peliculas') }}
        </h2>
    </x-slot>
</x-app-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <div class="flex justify-center mt-6">
        <table class="w-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Título</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forEach ($peliculas as $pelicula)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="{{ route('peliculas.show', $pelicula) }}">{{ $pelicula->titulo }}</a>
                    </th>
                    <td class="px-6 py-4">
                        <a href="{{ route('peliculas.edit', $pelicula) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                        <form method="POST" action="{{ route('peliculas.destroy', $pelicula) }}">
                            @method('DELETE')
                            @csrf
                            <a href="{{ route('peliculas.destroy', $pelicula) }}"
                                class="font-medium text-black dark:text-blue-500 hover:underline"
                                onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                Eliminar
                            </a>
                        </form>
                    </td>
                </tr>
                @endforEach
            </tbody>
        </table>

    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('peliculas.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            Crear una nueva pelicula
        </a>
    </div>

</body>

</html>
