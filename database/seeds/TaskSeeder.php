<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();

        $tasks = [
            [
                'user_id' => 1,
                'name' => 'Buy some milk',
                'done' => false
            ],

            [
                'user_id' => 1,
                'name' => 'Put the clothes on to wash',
                'done' => true
            ],

            [
                'user_id' => 1,
                'name' => 'Tidy up the kitchen',
                'done' => false
            ]
        ];

        DB::table('tasks')->insert($tasks);
    }
}
