<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequest;
use App\Models\Book;
use App\Models\Collection;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Collection::with('books', 'user')->where('user_id', auth()->id())->latest()->get();

        return response()->json($collections);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CollectionRequest $request)
    {
        $collection = new Collection();

        $collection->name = $request->name;
        $collection->user_id = $request->user_id;

        $collection->save();

        if(isset($request->book_id)){
            $bookId = $request->book_id;
            $book = Book::findOrFail($bookId);
            $collection->books()->attach($book);
        }

        return response()->json($collection);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $collection = Collection::query()
        ->with('books')
        ->where('id', $request->id)
        ->firstOrFail();

        return response()->json($collection);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
