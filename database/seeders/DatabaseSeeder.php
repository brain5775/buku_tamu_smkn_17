<?php

namespace Database\Seeders;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Event;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Subject::create([
            'name'=>'Bahasa Indonesia',
        ]);
        Subject::create([
            'name'=>'MTK',
        ]);
        Subject::create([
            'name'=>'Programming',
        ]);

        Teacher::create([
            'name'=>'Budi',
            'subject_id'=>1,
            'email'=>'Budi@gmail.com',
        ]);
        Teacher::create([
            'name'=>'Doni',
            'subject_id'=>2,
            'email'=>'Doni@gmail.com',
        ]);
        Teacher::create([
            'name'=>'Andre',
            'subject_id'=>2,
            'email'=>'Andre@gmail.com',
        ]);
    }
}
