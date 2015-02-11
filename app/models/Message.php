<?php

class Message extends \Eloquent
{

    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['to', 'from', 'msg'];

    public function user()
    {
        return $this->belongsTo('User');
    }
}