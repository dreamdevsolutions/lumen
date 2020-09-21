<?php


namespace App\Listeners;


use App\Events\ActionEvent;

class ActionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActionEvent  $event
     * @return void
     */
    public function handle(ActionEvent $event)
    {
        $event->model->actions()->create(['action' => $event->action]);
    }
}
