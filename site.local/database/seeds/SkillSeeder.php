<?php

use Illuminate\Database\Seeder;

class
SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Аудирование',
                'description' => 'Навык аудирования',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Говорение',
                'description' => 'Умение говорить, правильность произношения',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Письменная речь',
                'description' => 'Навык хорошо писать',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $datum) {
            DB::table('skill')->insert($datum);
        }
    }

}
