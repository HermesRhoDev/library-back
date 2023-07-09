<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequest;
use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $collections = Collection::with('books')
            ->where('user_id', $userId)
            ->orWhere(function ($query) use ($userId) {
                $query->whereDoesntHave('books')
                    ->where('user_id', $userId);
            })
            ->latest()
            ->get();

        return response()->json($collections);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionRequest $request)
    {
        $collection = new Collection();

        $collection->name = $request->name;
        $collection->user_id = auth()->id();

        $collection->save();

        if(isset($request->book_id)){
            $bookId = $request->book_id;
            $book = Book::findOrFail($bookId);
            $collection->books()->attach($book);
        }

        return response()->json($collection, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $collection = Collection::with('books')
            ->leftJoin('book_collection', 'collections.id', '=', 'book_collection.collection_id')
            ->where('collections.id', $id)
            ->select('collections.*', 'book_collection.book_id')
            ->firstOrFail();

        return response()->json($collection);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collection::findOrFail($id);

        $collection->name = $request->name; // Met à jour le nom de la collection avec la valeur du champ "name" dans la requête

        $collection->save();

        if (isset($request->book_id)) {
            $bookId = $request->book_id;
            $book = Book::findOrFail($bookId);
            $collection->books()->sync([$book->id]); // Met à jour les livres associés à la collection avec le livre spécifié
        } else {
            $collection->books()->detach(); // Supprime toutes les associations de livres pour cette collection s'il n'y a pas de livre spécifié
        }

        return response()->json($collection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $collection = Collection::find($id);
        if(!$collection){
            return response()->json(['message'=>"pas de collection", $collection], 404);
        }

        $collection->books()->detach(); // Supprime toutes les associations de livres pour cette collection
        $collection->delete(); // Supprime la collection elle-même

        return response()->json(['message' => 'Collection deleted successfully', 'test' => $collection], 200);
    }
}
