<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillLevelSeeder extends Seeder
{

    /** @var array */
    protected $data = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skill')->orderBy('id')->each(function ($skill) {
            $scale = random_int(1, 10);
            $this->data = array_merge($this->data, [
                [
                    'name' => 'Начинающий',
                    'description' => 'Вам есть куда стремиться!',
                    'threshold' => $scale+1,
                    'skill_id' => $skill->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Подрастающий',
                    'description' => 'Прогресс очевиден. Вперёд!',
                    'threshold' => $scale+4,
                    'skill_id' => $skill->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Профи',
                    'description' => 'Не понятно кто из нас преподаватель.',
                    'threshold' => $scale+7,
                    'skill_id' => $skill->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });

        foreach ($this->data as $datum) {
            DB::table('skill_level')->insert($datum);
        }
    }
}
