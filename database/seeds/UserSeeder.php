<?php

use App\Board;
use App\Topic;
use App\Thread;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 2)->create()->each(function ($user){
            $user->topics()->save(factory(Topic::class)->make());
            $user->threads()->save(factory(Thread::class)->make());
            $user->boards()->save(factory(Board::class)->make());
        });
    }
}
