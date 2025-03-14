@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($book->cover)
            <img src="{{ asset('storage/' . $book->cover) }}"
                 alt="{{ $book->title }} Cover"
                 class="w-full h-96 object-cover">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                <span>Нет обложки</span>
            </div>
        @endif

        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $book->title }}</h1>

            <div class="space-y-4">
                <div>
                    <span class="font-semibold">Автор:</span>
                    <p class="text-gray-600">{{ $book->author }}</p>
                </div>

                <div>
                    <span class="font-semibold">Дата издания:</span>
                    <p class="text-gray-600">{{ $book->issued->format('F j, Y') }}</p>
                </div>
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('books.edit', $book) }}"
                   class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Изменить данные
                </a>

                <form method="POST" action="{{ route('books.destroy', $book) }}"
                      onsubmit="return confirm('Are you sure you want to delete this book?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                        Удалить книгу
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('books.index') }}"
           class="text-indigo-600 hover:text-indigo-800">
            На главную
        </a>
    </div>
</div>
@endsection
