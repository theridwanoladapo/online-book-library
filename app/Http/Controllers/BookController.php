<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all books along with there authors
        $books = Book::get();

        return response()->json(
            BookResource::collection($books)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        // Create a new book
        $book = Book::create($validated);

        return response()->json(
            new BookResource($book),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // Retrieve and return a single book
        return response()->json(
            new BookResource($book)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Validate the request data
        $validated = $request->validated();

        // Find the book and update it
        $book->update($validated);

        return response()->json(
            new BookResource($book)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Find the book and delete it
        $book->delete();

        return response()->json(null, 204);
    }

    /**
     * Search books.
     */
    public function search(Request $request)
    {
        // Search and retrieve books
        $query = $request->input('query');
        $books = Book::where('title', 'like', "%$query%")
                    ->orWhereHas('author', function ($q) use ($query) {
                        $q->where('name', 'like', "%$query%");
                    })
                    ->get();

        return response()->json(
            BookResource::collection($books)
        );
    }
}
