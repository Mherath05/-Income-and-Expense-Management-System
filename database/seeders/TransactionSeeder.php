<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        $incomeCategories = Category::where('type', 'income')->get();
        $expenseCategories = Category::where('type', 'expense')->get();

        foreach ($users as $user) {
           
            for ($i = 0; $i < 10; $i++) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $incomeCategories->random()->id,
                    'title' => $faker->sentence(3),
                    'amount' => $faker->randomFloat(2, 100, 5000),
                    'type' => 'income',
                    'description' => $faker->optional()->sentence(),
                    'date' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                ]);
            }

           
            for ($i = 0; $i < 20; $i++) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $expenseCategories->random()->id,
                    'title' => $faker->sentence(3),
                    'amount' => $faker->randomFloat(2, 10, 1000),
                    'type' => 'expense',
                    'description' => $faker->optional()->sentence(),
                    'date' => $faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
                ]);
            }
        }
    }
}