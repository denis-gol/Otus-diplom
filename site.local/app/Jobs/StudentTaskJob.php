<?php

namespace App\Jobs;

use App\Handlers\StudentTaskHandler;
use App\Model\StudentTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StudentTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var StudentTask */
    protected $task;

    /**
     * StudentTaskJob constructor.
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @param StudentTaskHandler $handler
     * @return void
     */
    public function handle(StudentTaskHandler $handler)
    {
        if ($this->task instanceof StudentTask) {
            $handler->handle($this->task);
        }
    }
}
