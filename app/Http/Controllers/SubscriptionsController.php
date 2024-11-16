<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;

class SubscriptionsController extends Controller
{
    //
    public function index()
    {
        $subscriptions = Subscription::all();
        // check if user have a subscription
        $user = auth()->user();
        
        if ($user) {
            // get the active subscription of the user
            $userSubscriptions = $user->subscriptions()->wherePivot('active', true)->get();
            
            error_log("subscriptions: " . $subscriptions);
            error_log("subscriptionsUsers: " . $userSubscriptions);
            
            //$subscriptionsUsers = $user->subscriptions;
            // Autre façon de faire : Ajouter une clé 'isActive' à chaque abonnement
            
            // $subscriptions = $subscriptions->map(function($subscription) use ($subscriptionsUsers) {
            //     $subscription->isActive = $subscriptionsUsers->contains('id', $subscription->id);
            //     return $subscription;
            // });
            //error_log("subscriptions: " . $subscriptions);
            // mais ça veut dire que je modifier l'objet original que je reçois

            return view('subscriptions.index', compact('subscriptions', 'userSubscriptions'));
        }
        $userSubscriptions = collect([]);
        return view('subscriptions.index', compact('subscriptions', 'userSubscriptions'));
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    public function subscribe(Subscription $subscription)
    {

        // on vérifie si l'utilisateur est connecté
        // si non, on le redirige vers la page de connexion
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Vérifier si l'utilisateur a déjà cet abonnement actif
        $existingSubscriptionActiveWithThisID = $user->subscriptions()
            ->where('subscription_id', $subscription->id)
            ->where('active', true)
            ->first();

        if ($existingSubscriptionActiveWithThisID) {
            return redirect()->route('subscriptions.index')
                ->with('error', 'Vous avez déjà cet abonnement actif');
        }

        // Désactiver l'abonnement actif existant s'il y en a un
        $activeSubscription = $user->subscriptions()
            ->wherePivot('active', true)
            ->first();

        if ($activeSubscription) {
            $user->subscriptions()->updateExistingPivot($activeSubscription->id, [
                'active' => false,
                'end_date' => now()
            ]);
        }

        // Créer le nouvel abonnement
        $user->subscriptions()->attach($subscription, [
            'active' => true,
            'start_date' => now(),
            'end_date' => now()->addDays($subscription->duration)
        ]);

        return redirect()->route('subscriptions.index')
            ->with('success', 'Vous avez souscrit à l\'abonnement ' . $subscription->name);
    }

    public function create()
    {
        return view('subscriptions.create');
    }

    public function store(Request $request)
    {
        $subscription = Subscription::create($request->all());
        return redirect()->route('subscriptions.index');
    }
}
