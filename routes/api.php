<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MagazineController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$router->pattern('id', '[0-9]+');

Route::prefix('magazine')->group(function ($route) {
    $route->get('', [MagazineController::class, 'index']);
    $route->post('', [MagazineController::class, 'store']);
    $route->get('{id}', [MagazineController::class, 'show']);
    $route->match(['put', 'patch'], '{id}', [MagazineController::class, 'update']);
    $route->delete('{id}', [MagazineController::class, 'destroy']);
});

Route::prefix('category')->name('category.')->group(function ($route) {
    $route->get('', [CategoryController::class, 'index'])->name('index');
    $route->post('', [CategoryController::class, 'store'])->name('store');
    $route->get('{id}', [CategoryController::class, 'show'])->name('show');
    $route->match(['put', 'patch'], '{id}', [CategoryController::class, 'update'])->name('update');
    $route->delete('{id}', [CategoryController::class, 'destroy'])->name('destroy');
});
