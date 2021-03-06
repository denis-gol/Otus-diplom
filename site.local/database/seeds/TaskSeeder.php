<?php


use App\Entity\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table('lesson')->orderBy('id')
            ->each(function ($lesson) use ($faker) {
                $data = [
                    [
                        'lesson_id' => $lesson->id,
                        'name' => ucfirst($faker->word),
                        'description' => $faker->realText(50, 2),
                        'max_point' => random_int(6, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'lesson_id' => $lesson->id,
                        'name' => ucfirst($faker->word),
                        'description' => $faker->realText(50, 2),
                        'max_point' => random_int(6, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'lesson_id' => $lesson->id,
                        'name' => ucfirst($faker->word),
                        'description' => $faker->realText(50, 2),
                        'max_point' => random_int(6, 10),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ];

                foreach ($data as $datum) {
                    DB::table('task')->insert($datum);
                }
            });

        $tasks = Task::all();
        $tasks->each(function ($task) {
            $percent1 = random_int(1, 4)*10;

            /** @var Task $task */
            $task->skills()->attach([random_int(1,2)], ['percent_for_skill' => $percent1]);
            $task->skills()->attach([3], ['percent_for_skill' => 100-$percent1]);
        });
    }
}
