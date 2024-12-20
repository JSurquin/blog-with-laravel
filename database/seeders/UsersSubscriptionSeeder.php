<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsersSubscriptions;
class UsersSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UsersSubscriptions::create([
            'user_id' => 2,
            'subscription_id' => 1,
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'active' => true,
        ]);
    }
}
