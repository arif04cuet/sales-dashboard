<?php

class Document extends \Eloquent
{

    protected $table = 'order_documents';
    // Add your validation rules here
    public static $rules = [
        // 'title' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['order_id', 'user_id', 'comment','file_name'];

    public function order()
    {
        return $this->belongsTo('Order');
    }

    public function user()
    {
        return $this->belongsTo('Cartalyst\Sentry\Users\Eloquent\User');
    }

}