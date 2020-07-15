<?php

use App\Entity\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class SkillSeeder
 */
class SkillSeeder extends Seeder
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
                'type' => Skill::OTHER_TYPE_CODE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Говорение',
                'description' => 'Умение говорить, правильность произношения',
                'type' => Skill::TALKATIVE_TYPE_CODE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Письменная речь',
                'description' => 'Навык хорошо писать',
                'type' => Skill::OTHER_TYPE_CODE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $datum) {
            DB::table('skill')->insert($datum);
        }
    }

}
