<?php

namespace App\Policies;

use App\Models\User;

class WishlistPolicy
{
    /**
     * Seul un utilisateur connecté peut voir sa propre wishlist.
     * On vérifie que l'utilisateur qui demande EST bien l'utilisateur
     * dont on veut voir la wishlist.
     */
    public function view(User $currentUser, User $profileUser): bool
    {
        // true seulement si je consulte MA wishlist, pas celle de quelqu'un d'autre
        return $currentUser->id === $profileUser->id;
    }

    /**
     * Seul un utilisateur connecté peut modifier sa wishlist.
     */
    public function update(User $currentUser): bool
    {
        // Tout utilisateur connecté peut gérer sa propre wishlist
        return true;
    }
}
