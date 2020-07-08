<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
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
                'name' => 'Английский язык',
                'description' => 'Изучение английского языка',
                'created_at' => now('-1 month'),
                'updated_at' => now('-2 weeks'),
            ],
            [
                'name' => 'Математика',
                'description' => 'Изучение математики',
                'created_at' => now('-2 month'),
                'updated_at' => now('-1 weeks'),
            ],
        ];

        foreach ($data as $datum) {
            DB::table('course')->insert($datum);
        }
    }
}
