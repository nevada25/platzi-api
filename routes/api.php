<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\userTokenController;
use \App\Http\Controllers\NewsletterController;

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

Route::resource('products', ProductController::class)
    ->middleware('auth:sanctum');

Route::resource('categories', ProductController::class)
    ->middleware('auth:sanctum');

Route::post('auth/login', [userTokenController::class, 'login']);


//Route::post('newsletter', [ NewsletterController::class, 'send']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('newsletter', [NewsletterController::class, 'send'])->name('send.newsletter');

    Route::post('products/{product}/rate', [ProductRatingController::class, 'rate']);
    Route::get('rating', [ProductRatingController::class, 'index']);
    Route::post('products/{product}/unrate', [ProductRatingController::class, 'unrate']);
    Route::post('rating/{rating}/approve', [ProductRatingController::class, 'approve']);
});
Route::get('exception', function () {
    throw new Exception('Soy una excepcion');
});

Route::get('/server-error', function () {
    abort(500);
});
