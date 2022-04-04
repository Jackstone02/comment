<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SecondaryCommentController;
use App\Http\Controllers\TertiaryCommentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/comments', [CommentController::class, 'getAllComments']);
Route::post('/comment/save', [CommentController::class, 'store']);
Route::post('/secondary-comment/save', [SecondaryCommentController::class, 'store']);
Route::post('/tertiary-comment/save', [TertiaryCommentController::class, 'store']);