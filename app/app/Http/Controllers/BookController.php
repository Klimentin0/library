<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

    $books = Book::when($search, function ($query) use ($search) {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('author', 'like', "%$search%");
        });
    })->latest()->paginate(10);

    return view('books.index', compact('books', 'search'));
    }


    public function create()
    {
        return view('books.create');
    }


    public function store(BookRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $path = $request->file('cover')->store('books', 'public');
            $validated['cover'] = $path;
        }

        Book::create($validated);
        return redirect()->route('books.index')->with('success', 'Book added!');
    }


    public function show(Book $book)
    {
        return view('books.show', compact('book'));

    }


    public function edit(Book $book)
{
    return view('books.edit', compact('book'));
}


    public function update(BookRequest $request, Book $book)
{
    $validated = $request->validated();

    if ($request->hasFile('cover')) {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }
        $validated['cover'] = $request->file('cover')->store('books', 'public');
    }

    $book->update($validated);
    return redirect()->route('books.index')->with('success', 'Book updated!');
}


    public function destroy(Book $book)
    {
        if ($book->cover) {
            Storage::disk('public')->delete($book->cover);
        }

        $book->delete();
        return redirect('/')->with('success', 'Книга удалена!');
    }
}
