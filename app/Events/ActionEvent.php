<?php


namespace App\Events;


use Illuminate\Database\Eloquent\Model;

class ActionEvent extends Event
{
    public $model;
    public $action;

    /**
     * Create a new event instance.
     *
     * @param Model $model
     * @param string $action
     */
    public function __construct(Model $model, string $action)
    {
        $this->model = $model;
        $this->action = $action;
    }
}
