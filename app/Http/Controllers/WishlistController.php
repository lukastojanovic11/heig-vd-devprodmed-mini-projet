<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Affiche la wishlist de l'utilisateur connecté.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Récupère tous les posts de la wishlist avec leurs infos
        $posts = $user->wishlist()
                      ->with('user')
                      ->with('likes')
                      ->with('category')
                      ->orderBy('wishlists.created_at', 'desc')
                      ->get();

        return view('wishlist.index', ['posts' => $posts]);
    }

    /**
     * Ajoute ou retire un post de la wishlist (toggle).
     */
    public function update(Request $request, string $postId)
    {
        $user = $request->user();

        // Vérifie si ce post est déjà dans la wishlist
        $exists = $user->wishlist()->where('post_id', $postId)->exists();

        if ($exists) {
            // Déjà en wishlist → on retire
            $user->wishlist()->detach($postId);
        } else {
            // Pas en wishlist → on ajoute
            $user->wishlist()->attach($postId);
        }

        return redirect("/posts/$postId");
    }
}
