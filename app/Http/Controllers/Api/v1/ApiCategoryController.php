<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;

class ApiCategoryController extends Controller
{
    /**
     * Retourne la liste de toutes les catégories en JSON.
     * GET /api/v1/categories
     * Nécessite un token avec le scope "categories:read"
     */
    public function index()
    {
        // withCount('posts') ajoute le nombre de posts par catégorie
        $categories = Category::withCount('posts')
                               ->orderBy('name')
                               ->get();

        // Laravel convertit automatiquement la collection en JSON
        return $categories;
    }

    /**
     * Retourne tous les posts d'une catégorie en JSON.
     * GET /api/v1/categories/{slug}/posts
     * Nécessite un token avec le scope "categories:read"
     */
    public function posts(string $slug)
    {
        // Si la catégorie n'existe pas → réponse 404 automatique
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
                          ->with('user')
                          ->with('likes')
                          ->orderBy('created_at', 'desc')
                          ->get();

        // On retourne un objet JSON structuré avec la catégorie et ses posts
        return response()->json([
            'category' => $category,
            'posts'    => $posts,
        ]);
    }
}
