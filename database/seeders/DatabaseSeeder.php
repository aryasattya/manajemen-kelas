<?php

namespace Database\Seeders;

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

      

        $userData = [

            [
              "username" =>"admin",
              "email" => "admin@gmail.com",
              "password" => bcrypt("admin123"),        
            ]
          
          ];
  
        foreach($userData as $key => $value) {
          User::create($value);
        }
    
    }
}
