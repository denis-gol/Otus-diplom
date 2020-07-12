<?php

namespace App\Events;

use App\Entity\Student;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AchievementCalculatorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Student */
    protected $student;

    /**
     * AchievementCalculatorEvent constructor.
     * @param Student $student
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

}
