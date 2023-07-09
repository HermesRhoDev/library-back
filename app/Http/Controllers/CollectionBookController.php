<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionBookController extends Controller
{
    /**
     * Add a book to a collection.
     */
    public function addBookToCollection(Request $request, string $collectionId)
    {
        $collection = Collection::findOrFail($collectionId);

        // Get the book data from the request
        $bookData = $request->only([
            'id',
            'title',
            'pageCount',
            'authors',
            'categories',
            'cover_link',
            'summary'
        ]);

        // Assign the specified ID to the book
        $bookId = $request->input('id');

        // Check if the book already exists in the database
        $book = Book::find($bookId);

        if ($book) {
            // Check if the book is already associated with the collection
            if ($collection->books()->where('book_id', $bookId)->exists()) {
                return response()->json(['message' => 'Ce livre est déjà dans la collection.'], 422);
            }
        } else {
            // Create a new book if it doesn't exist in the database
            $book = Book::create($bookData);
        }

        $collection->books()->attach($book);

        return response()->json(['message' => 'Livre ajouté à la collection avec succès.'], 200);
    }

    /**
     * Remove a book from a collection.
     */
    public function removeBook(string $collectionId, string $bookId)
    {
        $collection = Collection::findOrFail($collectionId);

        $collection->books()->detach($bookId);

        return response()->json(['message' => 'Livre supprimé de la collection avec succès.'], 200);
    }

    /**
     * Get all public collections.
     */
    public function getPublicCollections()
    {
        $collections = Collection::where('isPublic', 1)->get();

        return response()->json(['collections' => $collections], 200);
    }

    /**
     * Set a collection as public.
     */
    public function setCollectionAsPublic(string $collectionId)
    {
        $collection = Collection::findOrFail($collectionId);

        $collection->isPublic = true;
        $collection->save();

        return response()->json(['message' => 'Collection rendue publique avec succès.'], 200);
    }

    /**
     * Set a collection as private.
     */
    public function setCollectionAsPrivate(string $collectionId)
    {
        $collection = Collection::findOrFail($collectionId);

        $collection->isPublic = false;
        $collection->save();

        return response()->json(['message' => 'Collection rendue privée avec succès.'], 200);
    }
}