<?php

class Invitation extends \Eloquent
{

    protected $table = 'order_invitation';
    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['order_id', 'user_id', 'status'];

    public function getStatus()
    {
        return $this->status ? 'Accepted' : 'Pending';
    }

    public function order()
    {
        return $this->belongsTo('Order');
    }

    public function user()
    {
        return $this->belongsTo('Cartalyst\Sentry\Users\Eloquent\User');
    }

    public function getUserType()
    {
        $group = $this->user->getGroups()->toArray();
        return $group[0]['name'];
    }

}