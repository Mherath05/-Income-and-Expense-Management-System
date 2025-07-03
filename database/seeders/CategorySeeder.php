<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            //My Income Categories
            ['name' => 'Salary', 'type' => 'income', 'description' => 'Monthly salary income'],
            ['name' => 'Freelance', 'type' => 'income', 'description' => 'Freelance work income'],
            ['name' => 'Investment', 'type' => 'income', 'description' => 'Investment returns'],
            ['name' => 'Business', 'type' => 'income', 'description' => 'Business income'],
            ['name' => 'Rental', 'type' => 'income', 'description' => 'Rental income'],
            ['name' => 'Other Income', 'type' => 'income', 'description' => 'Other income sources'],

            //My Expense Categories
            ['name' => 'Food & Dining', 'type' => 'expense', 'description' => 'Food and restaurant expenses'],
            ['name' => 'Transportation', 'type' => 'expense', 'description' => 'Transportation costs'],
            ['name' => 'Housing', 'type' => 'expense', 'description' => 'Rent, mortgage, utilities'],
            ['name' => 'Healthcare', 'type' => 'expense', 'description' => 'Medical expenses'],
            ['name' => 'Entertainment', 'type' => 'expense', 'description' => 'Movies, games, hobbies'],
            ['name' => 'Shopping', 'type' => 'expense', 'description' => 'Clothing, electronics, etc.'],
            ['name' => 'Education', 'type' => 'expense', 'description' => 'Books, courses, training'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'description' => 'Monthly bills'],
            ['name' => 'Other Expenses', 'type' => 'expense', 'description' => 'Other expense categories'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}