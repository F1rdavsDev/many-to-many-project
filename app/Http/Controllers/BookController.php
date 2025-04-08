<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookCreateRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('authors')->get(); 
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all(); 
        return view('books.create', compact('authors'));    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(BookCreateRequest $request)
     {
         $book = Book::create([
             'title' => $request->input('title'),  
             'description' => $request->input('description')  
         ]);
     
         $book->authors()->attach($request->input('authors'));  
     
         return redirect()->route('books.index');
     }
     

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
    
        $book->authors()->sync($request->authors ); // detach ham ishlayddi, ham update ishlaydi  
        return redirect()->route('books.index');
    }
    

    
    /**
     * Remove the specified resource from storage.
     */


public function destroy(string $id)
{
    $book = Book::findOrFail($id);

    $book->authors()->detach();

    $book->delete();

    return redirect()->route('books.index')->with('success', 'Kitob va uning mualliflari o\'chirildi.');
}

}