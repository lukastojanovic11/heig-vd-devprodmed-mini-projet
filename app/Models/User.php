<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the posts for the user.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the posts liked by the user.
     */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes')->using(Like::class)->withTimestamps()->withPivot('reaction');
    }

    /**
 * Les posts que l'utilisateur a ajoutés à sa wishlist.
 * C'est une relation many-to-many via la table pivot wishlists.
 * Un user peut avoir plusieurs posts en wishlist,
 * et un post peut être dans la wishlist de plusieurs users.
 */
public function wishlist(): BelongsToMany
{
    return $this->belongsToMany(Post::class, 'wishlists')->withTimestamps();
}
}
