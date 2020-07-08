<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('course')->orderBy('id')
            ->each(function ($course) {
                $data = [
                    [
                        'course_id' => $course->id,
                        'name' => Str::lower(Str::random()),
                        'description' => Str::lower(Str::random()),
                        'goal' => Str::lower(Str::random()),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'course_id' => $course->id,
                        'name' => Str::lower(Str::random()),
                        'description' => Str::lower(Str::random()),
                        'goal' => Str::lower(Str::random()),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];

                foreach ($data as $datum) {
                    DB::table('lesson')->insert($datum);
                }
            });
    }
}
