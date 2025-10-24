<x-app-layout>
    <!-- Hero Section with Actions -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
                    Tous nos 
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                        Articles
                    </span>
                </h1>
                <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
                    Explorez notre collection d'articles couvrant les dernières technologies, tutoriels et actualités du monde du développement
                </p>
                
                @can("create", \App\Models\Post::class)
                    <div class="mt-8">
                        <a href="{{ route('posts.create') }}" class="group inline-flex items-center space-x-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-4 text-base font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Créer un nouvel article</span>
                        </a>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="bg-gray-50 py-16 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @include('posts.partials.all-articles')
        </div>
    </div>
</x-app-layout>
