<?php

use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
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
                'name' => 'Простой орел',
                'description' => 'Средний балл не ниже 3',
                'discriminator' => 'eagle_1',
                'threshold' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мудрый орел',
                'description' => 'Средний балл не ниже 4',
                'discriminator' => 'eagle_2',
                'threshold' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Супер орел',
                'description' => 'Средний балл не ниже 5',
                'discriminator' => 'eagle_3',
                'threshold' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Занятый',
                'description' => 'Провел 10 часов за уроками',
                'discriminator' => 'work_10',
                'threshold' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Трудяга',
                'description' => 'Провел 100 часов за уроками',
                'discriminator' => 'work_100',
                'threshold' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $datum) {
            DB::table('achievement')->insert($datum);
        }
    }

}
