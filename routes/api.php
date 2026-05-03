<?php

use App\Http\Controllers\Api\v1\ApiPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\ApiCategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/posts', ApiPostController::class)
    ->middlewareFor(['index', 'show'], ['auth:sanctum', 'abilities:posts:read'])
    ->middlewareFor(['store'], ['auth:sanctum', 'abilities:posts:create'])
    ->middlewareFor(['update'], ['auth:sanctum', 'abilities:posts:update'])
    ->middlewareFor(['destroy'], ['auth:sanctum', 'abilities:posts:delete']);

    // Routes API pour les catégories
// Nécessitent un token avec le scope "categories:read"
Route::get('v1/categories', [ApiCategoryController::class, 'index'])
     ->middleware(['auth:sanctum', 'abilities:categories:read']);

Route::get('v1/categories/{slug}/posts', [ApiCategoryController::class, 'posts'])
     ->middleware(['auth:sanctum', 'abilities:categories:read']);
