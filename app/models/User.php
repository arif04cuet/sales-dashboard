<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Cartalyst\Sentry\Users\Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $test = 'asd';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    public function messagesSend()
    {
        return $this->hasMany('Message', 'from');
    }

    public function messagesReceieved()
    {
        return $this->hasMany('Message', 't0');
    }

    public function invitations()
    {
        return $this->hasMany('Invitation');
    }

    public function documents()
    {
        return $this->hasMany('Document');
    }


}
