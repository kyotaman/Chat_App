<?php

use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 20 ; $i++) {

            \App\Message::create([
                'name' => $i .'番',
                'body' => $i .'番目のテキスト'
            ]);

        }
    }}
