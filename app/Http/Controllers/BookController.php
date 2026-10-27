<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // د کتابونو ښکاره کول
    public function index()
    {
        $books = Book::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard', compact('books'));
    }

    // د نوي کتاب ثبتول
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:100',
            'pages' => 'required|integer|min:1|max:10000',
        ]);

        $validated['user_id'] = auth()->id();

        Book::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Book registered successfully!');
    }

    // د کتاب حذف کول
    public function destroy($id)
    {
        $book = Book::where('user_id', auth()->id())
            ->findOrFail($id);

        $book->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Book deleted successfully!');
    }
}

