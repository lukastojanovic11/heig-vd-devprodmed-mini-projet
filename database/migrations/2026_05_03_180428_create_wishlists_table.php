<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            // Clé étrangère vers l'utilisateur qui a ajouté le post à sa wishlist
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete(); // si l'user est supprimé, sa wishlist aussi

            // Clé étrangère vers le post ajouté en wishlist
            $table->foreignId('post_id')
                  ->constrained('posts')
                  ->cascadeOnDelete(); // si le post est supprimé, retiré des wishlists

            // Les deux colonnes ensemble forment la clé primaire
            // = un user ne peut pas ajouter le même post deux fois
            $table->primary(['user_id', 'post_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};
