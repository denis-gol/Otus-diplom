<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'description' => 'Средний балл не ниже 0,75',
                'discriminator' => 'App\Listeners\AchievementAvgGrades',
                'threshold' => 0.75,
                'icon' => 'simple_bird.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мудрый орел',
                'description' => 'Средний балл не ниже 0.85',
                'discriminator' => 'App\Listeners\AchievementAvgGrades',
                'threshold' => 0.85,
                'icon' => 'wise_bird.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Супер орел',
                'description' => 'Средний балл не ниже 1',
                'discriminator' => 'App\Listeners\AchievementAvgGrades',
                'threshold' => 1,
                'icon' => 'super_bird.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ясли',
                'description' => 'Выполнил первое задания разговорного навыка',
                'discriminator' => 'App\Listeners\AchievementTalkative',
                'threshold' => 1,
                'icon' => 'baby.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Детсадовец',
                'description' => 'Преодолел 3 задания разговорного навыка',
                'discriminator' => 'App\Listeners\AchievementTalkative',
                'threshold' => 1,
                'icon' => 'kindergartner.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Андрей Малахов',
                'description' => 'Выполнил все задания разговорного навыка',
                'discriminator' => 'App\Listeners\AchievementExcellentTalkative',
                'threshold' => 1,
                'icon' => 'malakhov.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $datum) {
            DB::table('achievement')->insert($datum);
        }
    }

}
