<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        $user = User::factory()->create([
            'name' => 'Riccardo',
            'email' => 'riccardonuzz@yahoo.it'
        ]);

        $categories = Category::factory()->count(10)->create();
        $todos = Todo::factory(5)->create();

        
        
        
        $todos->each(function($todo) use ($categories) {
            $pickedCategories = array_rand($categories->toArray(), rand(0, 4));
            $todo->categories()->attach($pickedCategories);
        });
    }
}
