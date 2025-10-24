<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="mb-4 inline-flex">
                    <span class="rounded-full bg-indigo-100 px-4 py-1.5 text-sm font-semibold text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300">
                        💎 Plans & Tarifs
                    </span>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
                    Choisissez votre
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-purple-400">
                        Abonnement
                    </span>
                </h1>
                <p class="mx-auto mt-6 max-w-2xl text-xl text-gray-600 dark:text-gray-300">
                    Accédez à du contenu premium et soutenez nos créateurs. Choisissez l'offre qui vous convient le mieux.
                </p>
            </div>
        </div>
    </div>

    <!-- Messages Flash -->
    @if (session('success'))
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center space-x-3 rounded-2xl bg-green-50 p-4 shadow-lg dark:bg-green-900/20">
                <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center space-x-3 rounded-2xl bg-red-50 p-4 shadow-lg dark:bg-red-900/20">
                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Pricing Cards -->
    <div class="bg-gray-50 py-16 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-2 lg:gap-12">
                @foreach ($subscriptions as $subscription)
                    @php
                        $isActive = $userSubscriptions->contains('id', $subscription->id);
                        $isPremium = $subscription->price > 0;
                    @endphp

                    <div class="group relative overflow-hidden rounded-3xl bg-white shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:shadow-3xl dark:bg-gray-800 {{ $isPremium ? 'border-2 border-indigo-500' : '' }}">
                        <!-- Badge Premium -->
                        @if ($isPremium)
                            <div class="absolute right-6 top-6">
                                <span class="inline-flex items-center space-x-1 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 px-3 py-1.5 text-xs font-bold text-white shadow-lg">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span>Populaire</span>
                                </span>
                            </div>
                        @endif

                        <!-- Gradient Background -->
                        <div class="relative h-32 overflow-hidden bg-gradient-to-br {{ $isPremium ? 'from-indigo-500 via-purple-500 to-pink-500' : 'from-gray-400 via-gray-500 to-gray-600' }}">
                            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iZ3JpZCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJ3aGl0ZSIgc3Ryb2tlLW9wYWNpdHk9IjAuMSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-30"></div>
                        </div>

                        <div class="p-8">
                            <!-- Plan Name -->
                            <h2 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                                {{ $subscription->name }}
                            </h2>
                            
                            <!-- Description -->
                            <p class="mb-6 min-h-[4rem] text-gray-600 dark:text-gray-300">
                                {{ $subscription->description }}
                            </p>

                            <!-- Price -->
                            <div class="mb-8">
                                <div class="flex items-baseline">
                                    <span class="text-5xl font-extrabold text-gray-900 dark:text-white">
                                        {{ $subscription->price }}€
                                    </span>
                                    <span class="ml-2 text-gray-500 dark:text-gray-400">/mois</span>
                                </div>
                            </div>

                            <!-- Features -->
                            <ul class="mb-8 space-y-4">
                                @if ($isPremium)
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Accès à tous les articles premium</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Contenu exclusif chaque semaine</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Support prioritaire</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Badge membre premium</span>
                                    </li>
                                @else
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Accès aux articles gratuits</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700 dark:text-gray-300">Commentaires illimités</span>
                                    </li>
                                    <li class="flex items-center space-x-3">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-gray-400 line-through dark:text-gray-600">Contenu premium</span>
                                    </li>
                                @endif
                            </ul>

                            <!-- CTA Button -->
                            <form action="{{ route('subscriptions.subscribe', $subscription->id) }}" method="POST">
                                @csrf
                                @if ($isActive)
                                    <div class="flex items-center justify-center space-x-2 rounded-xl border-2 border-green-500 bg-green-50 px-6 py-4 text-green-700 dark:bg-green-900/20 dark:text-green-300">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-semibold">Abonnement actif</span>
                                    </div>
                                @else
                                    <button type="submit" class="group w-full rounded-xl {{ $isPremium ? 'bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700' : 'bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600' }} px-6 py-4 font-bold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                                        <span class="flex items-center justify-center space-x-2">
                                            <span>S'abonner maintenant</span>
                                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </span>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Additional Info -->
            <div class="mt-16 text-center">
                <p class="text-gray-600 dark:text-gray-400">
                    💡 Tous les abonnements peuvent être annulés à tout moment. Aucun engagement.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
