@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-6">Изменить книгу</h1>

    <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
            <input type="text" name="title" id="title" required
                   minlength="3" maxlength="255"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   value="{{ old('title', $book->title) }}"
                   title="Минимум 3 символа, максимум 255 символов">
            @error('title')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="author" class="block text-sm font-medium text-gray-700">Автор</label>
            <input type="text" name="author" id="author" required
                   minlength="3" maxlength="255"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   value="{{ old('author', $book->author) }}"
                   title="Минимум 3 символа, максимум 255 символов">
            @error('author')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="issued" class="block text-sm font-medium text-gray-700">Дата издания</label>
            <input type="date" name="issued" id="issued" required
                   max="{{ now()->format('Y-m-d') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   value="{{ old('issued', $book->issued->format('Y-m-d')) }}"
                   title="Выберите дату издания">
            @error('issued')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cover" class="block text-sm font-medium text-gray-700">Обложка</label>
            @if($book->cover)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="Current cover" class="h-32">
                    <p class="mt-1 text-sm text-gray-500">Текущая обложка</p>
                </div>
            @endif
            <input type="file" name="cover" id="cover"
                   accept="image/png, image/jpeg, image/jpg, image/gif"
                   class="mt-4 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                   title="Допустимые форматы: PNG, JPEG, JPG, GIF">
            @error('cover')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('books.index') }}"
               class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                Отмена
            </a>
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Изменить
            </button>
        </div>
    </form>
</div>
@endsection
