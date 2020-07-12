<?php


namespace App\Listeners;


use App\Events\AchievementCalculatorEvent;

class AchievementTalkative
{
    /**
     * Handle the event.
     *
     * @param  AchievementCalculatorEvent  $event
     * @return void
     */
    public function handle(AchievementCalculatorEvent $event)
    {
        logs()->info(self::class);
    }
}
