<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Subscription extends Model
{
    //
    protected $fillable = ['name', 'description', 'price'];


    public function users()
    {
        return $this->belongsToMany(User::class, 'users_subscriptions', 'subscription_id', 'user_id');
    }
}
