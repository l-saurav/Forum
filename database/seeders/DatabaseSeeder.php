<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\discussion;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
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
        /*User::factory()->create([
            'name' => 'Saurav',
            'email' => 'saurav.182020@ncit.edu.np',
        ]);*/
        User::factory(20)->create();

        Category::factory()->create(['name' => 'General']);
        Category::factory()->create(['name' => 'Curriculum']);
        Category::factory()->create(['name' => 'Examination']);
        Category::factory()->create(['name' => 'Project']);
        Category::factory()->create(['name' => 'Result']);

        /*
        Status::factory()->create(['name' => 'Open']);
        Status::factory()->create(['name' => 'Considering']);
        Status::factory()->create(['name' => 'In Progress']);
        Status::factory()->create(['name' => 'Implemented']);
        Status::factory()->create(['name' => 'Closed']);
        */

        Status::factory()->create(['name' => 'Unreviewed']);
        Status::factory()->create(['name' => 'Off Topic']);
        Status::factory()->create(['name' => 'Announcement']);
        Status::factory()->create(['name' => 'Unsolved']);
        Status::factory()->create(['name' => 'Solved']);
        
        discussion::factory(100)->existing()->create();

        //Generate unique votes. Ensure discussion_id and user_id are unique for each row
        foreach (range(1, 20) as $user_id) {
            foreach (range(1, 100) as $discussion_id) {
                if ($discussion_id % 2 === 0) {
                    Vote::factory()->create([
                        'user_id' => $user_id,
                        'discussion_id' => $discussion_id,
                    ]);
                }
            }
        }

        //Generate comment for discussion
        foreach(discussion::all() as $discussion){
            Comment::factory(5)->existing()->create(['discussion_id' => $discussion->id]);
        }



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
