<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Profile;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Category;
use App\Models\StudentSubject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();
        Profile::factory()->count(10)->create();
        StudentSubject::factory()->count(10)->create();
        User::factory()->count(10)->create();
    }
}
