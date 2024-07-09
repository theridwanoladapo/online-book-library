<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all authors
        $authors = Author::all();

        return response()->json(
            AuthorResource::collection($authors)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        // Create a new author
        $author = Author::create($validated);

        return response()->json(
            new AuthorResource($author),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        // Retrieve and return a single author
        return response()->json(
            new AuthorResource($author)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        // Validate the request data
        $validated = $request->validated();

        // Find the author and update it
        $author->update($validated);

        return response()->json(
            new AuthorResource($author)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        // Find the author and delete it
        $author->delete();

        return response()->json(null, 204);
    }
}
