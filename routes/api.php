<?php

use App\Http\Controllers\CollectionBookController;
use App\Http\Controllers\CollectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('mycollections', [CollectionController::class, 'index'])->name('index');
    Route::get('collection/{id}', [CollectionController::class, 'show'])->name('show');
    Route::post('collection/store', [CollectionController::class, 'store'])->name('store');
    Route::delete('destroy-collection/{id}', [CollectionController::class, 'destroy'])->name('destroy');

    Route::post('collection/{collectionId}/add-book', [CollectionBookController::class, 'addBookToCollection'])->name('add-book');
    Route::delete('collection/{collectionId}/remove-book/{bookId}', [CollectionBookController::class, 'removeBook'])->name('remove-book');
});