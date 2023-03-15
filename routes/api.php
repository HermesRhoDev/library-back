<?php

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
    //************************** */ COLLECTION PART \* ******************************** \\
    Route::get('collections/{id}', [CollectionController::class, 'index'])->name('index');
    Route::get('collection/{id}', [CollectionController::class, 'show'])->name('show');
    Route::post('collection/store', [CollectionController::class, 'store'])->name('store');
});