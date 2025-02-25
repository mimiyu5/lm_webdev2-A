<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display all books
    public function index()
    {
        $books = Book::all();  // Fetch all books
        return view('index', compact('books')); // Pass books to the view
    }

    // Show form to create a book
    public function create()
    {
        return view('create');
    }

    // Store a new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
        ]);

        return redirect('/')->with('success', 'Book created successfully!');
    }

    // Show form to edit a book
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update the book
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
        ]);

        return redirect('/')->with('success', 'Book updated successfully!');
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/')->with('success', 'Book deleted successfully!');
    }
    
}
