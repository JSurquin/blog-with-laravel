<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="mb-4 text-center text-4xl font-bold text-gray-800 dark:text-white">Subscriptions</h1>
        <p class="mb-12 text-center text-xl text-gray-600 dark:text-white">Chez nous, vous pouvez choisir parmi plusieurs abonnements.</p>

        @if (session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-500">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-500">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($subscriptions as $subscription)
                <div class="rounded-lg bg-white p-6 shadow-lg transition duration-300 hover:shadow-xl dark:bg-gray-800 dark:opacity-80">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">{{ $subscription->name }}</h2>
                    <p class="mb-8 h-24 text-gray-600 dark:text-white">{{ $subscription->description }}</p>
                    <div class="flex flex-col items-center">
                        <p class="mb-6 text-4xl font-bold text-gray-800">{{ $subscription->price }}€</p>
                        <form action="{{ route('subscriptions.subscribe', $subscription->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-full {{ $userSubscriptions->contains('id', $subscription->id) ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-600 hover:bg-blue-700' }} px-8 py-3 font-bold transition duration-300">
                                <!-- {{ $subscription->isActive ? 'Renouveler' : 'S\'abonner' }} -->
                                  {{ $userSubscriptions->contains('id', $subscription->id) ? 'Déjà abonner' : 'S\'abonner' }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
