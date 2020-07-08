<?php


use App\Entity\Group;
use App\Entity\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GroupSeeder extends Seeder
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
                $dateStart = now()->modify('-'.random_int(1, 3).' month');
                $data = [
                    [
                        'start_date' => $dateStart,
                        'end_date' => (clone $dateStart)->modify('+'.random_int(10, 20).' days'),
                        'course_id' => $course->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'start_date' => $dateStart,
                        'end_date' => (clone $dateStart)->modify('+'.random_int(10, 20).' days'),
                        'course_id' => $course->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];

                foreach ($data as $datum) {
                    DB::table('group')->insert($datum);
                }
            });

        $groups = Group::all();
        $groups->each(function ($group) {
            $students = Student::query()->select('id')->limit(5)->inRandomOrder()->get()->toArray();
            $students = array_map(function ($student) {
                return $student['id'];
            }, $students);
            $group->students()->attach($students);
        });
    }
}
