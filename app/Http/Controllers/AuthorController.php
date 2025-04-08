<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorCreateRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::with('books')->get(); 
    
        return view('authors.index', compact('authors'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Kitoblar ro'yxatini olish
    $books = Book::all();

    // 'authors.create' view'ga kitoblar ro'yxatini uzatish
    return view('authors.create', compact('books'));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorCreateRequest $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'biography' => $request->biography,
        ]);
    
  
            // attach emas, sync ishlatiladi, chunki u takrorlanmaydi
            $author->books()->sync($request->books);
       
    
        return redirect()->route('authors.index');
    }
    

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::findOrFail($id);
    
        return view('authors.show', compact('author'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = Author::with('books')->findOrFail($id);
        $books = Book::all(); // Barcha kitoblar
    
        return view('authors.edit', compact('author', 'books'));
    }

    /**
     * Update the specified resource in storage.
     */
  
     public function update(AuthorUpdateRequest $request, string $id)
     {
         $author = Author::findOrFail($id);
         $author->update([
             'name' => $request->name,
             'biography' => $request->biography
         ]);
         
         $author->books()->sync(ids: $request->books); // detach ham ishlayddi, ham update ishlaydi  
     
         return redirect()->route('authors.index');
     }
     
     
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id); 
        $author->books()->detach(); 
        $author->delete();
        return redirect()->route('authors.index');
    }
    }


    