<?php

namespace App\Jobs;

use App\Entity\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $student; // = blogPost в обучалке

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->onQueue('asdfasdf');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info("создан новый студент [{$this->student->id}]");
    }
}
