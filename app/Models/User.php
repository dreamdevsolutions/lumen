<?php

namespace App\Models;

use App\Events\ActionEvent;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function(User $user) {
            event(new ActionEvent($user, Action::created));
        });

        static::updated(function(User $user) {
            event(new ActionEvent($user, Action::updated));
        });

        static::deleted(function(User $user) {
            event(new ActionEvent($user, Action::deleted));
        });
    }

    /**
     * Get all of the user's actions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function actions()
    {
        return $this->morphMany(Action::class, 'actionable');
    }
}
