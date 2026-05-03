<x-default-layout>
    <x-slot:title>
        Ma Wishlist
    </x-slot>

    <x-slot:description>
        Les jeux que vous voulez essayer
    </x-slot>

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold dark:text-white">
            🔖 Ma Wishlist
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                ({{ count($posts) }} jeu(x))
            </span>
        </h1>

        <a href="{{ url('/posts') }}"
            class="text-sm text-teal-600 dark:text-purple-400 hover:underline">
            ← Tous les posts
        </a>
    </div>

    <div class="mt-8 space-y-6">
        {{-- On réutilise le composant post-card existant --}}
        @forelse ($posts as $post)
            <x-post-card :post="$post" />
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                Votre wishlist est vide. Parcourez les posts et ajoutez des jeux !
            </p>
        @endforelse
    </div>
</x-default-layout>
