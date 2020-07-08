<?php

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
        // также заполняет users
        $this->call(StudentSeeder::class);

        $this->call(AchievementSeeder::class);
        $this->call(SkillSeeder::class);
    }

}
