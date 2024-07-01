<?php

namespace Database\Seeders;

use App\Models\Priority;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

  
        //User::truncate();
       // Task::truncate();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $priorityDefault = Priority::find(1);
        Task::factory(10)->create([
            'priority_id' => $priorityDefault->id,
        ]);
      
        

      
    }
}
