<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MessageBoardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/MessageBoard', [MessageBoardController::class, "add"]);

Route::post('/MessageBoard/confirm', [MessageBoardController::class, "confirm"]);

Route::get('/MessageBoard/complete', function(){
    return view('MessageBoard.complete');
});

Route::get('/MessageBoard/index', [MessageBoardController::class, 'index']);

Route::get('/MessageBoard/edit/{id}', [MessageBoardController::class, 'edit']);

Route::post('/MessageBoard/edit/{id}', [MessageBoardController::class, 'update']);

Route::post('/MessageBoard/delete/{id}', [MessageBoardController::class, 'delete']);

// // 検索参考箇所
// Route::get('/MessageBoard/index', [MessageBoardController::class, 'index'])->name('messages.index');