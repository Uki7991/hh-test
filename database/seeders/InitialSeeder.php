<?php

namespace Database\Seeders;

use App\Models\Merchant;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(5)->create();

        Merchant::factory(5)->create();

        Payment::factory(10)->create();
    }
}
