@extends('layouts.app')

@section('content')

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8 border-b border-gray-200 pb-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-blue-500 bg-clip-text text-transparent">
                        Список книг
                    </h1>
                    <p class="mt-2 text-gray-500">Коллекция наших лучших произведений</p>
                </div>
                <a href="{{ route('books.create') }}"
                   class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200
                          flex items-center gap-2 shadow-md hover:shadow-lg">

                    Добавить книгу
                </a>
            </div>
        </div>
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start gap-4">
            <div class="w-full sm:w-1/2">
                <form method="GET" action="{{ route('books.index') }}" class="flex gap-2">
                    <input type="text"
                           name="search"
                           value="{{ $search }}"
                           placeholder="Поиск по названию или автору"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

                    <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition-colors">
                        Найти
                    </button>

                    @if($search)
                        <a href="{{ route('books.index') }}"
                           class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition-colors">
                            Сброс
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($books as $book)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($book->cover)
                        <img
                            src="{{ asset('storage/' . $book->cover) }}"
                            alt="{{ $book->title }} Cover"
                            class="w-full h-48 object-cover"
                        >
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            <span>Обложка отсутствует.</span>
                        </div>
                    @endif

                    <div class="p-6 flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-2">
                                <a href="{{ route('books.show', $book) }}"
                                   class="hover:text-indigo-600 transition-colors">
                                    {{ $book->title }}
                                </a>
                            </h2>
                            <p class="text-gray-600 mb-2">
                                <span class="font-semibold">Автор:</span> {{ $book->author }}
                            </p>
                            <p class="text-gray-600">
                                <span class="font-semibold">Издано:</span>
                                {{ $book->issued->format('F j, Y') }}
                            </p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('books.edit', $book) }}"
                                class="bg-indigo-100 text-indigo-800 px-3 py-1.5 rounded-md
                                        hover:bg-indigo-200 transition-colors duration-200
                                        flex items-center gap-1 shadow-sm hover:shadow-md">
                                <span class="text-sm">Изменить</span>
                            </a>
                            <form method="POST" action="{{ route('books.destroy', $book) }}"
                                onsubmit="return confirm('Вы уверены что хотите удалить эту книгу?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-100 text-red-800 px-3 py-1.5 rounded-md
                                            hover:bg-red-200 transition-colors duration-200
                                            flex items-center gap-1 shadow-sm hover:shadow-md">
                                    <span class="text-sm">Удалить</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $books->links() }}
        </div>
    </div>
    @endsection
