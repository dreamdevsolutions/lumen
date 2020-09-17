<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    const created = 'created';
    const updated = 'updated';
    const deleted = 'deleted';

    protected $fillable = ['action'];

    /**
     * Get the owning actionable model.
     *
     * @return mixed
     */
    public function actionable()
    {
        return $this->morphTo();
    }
}
