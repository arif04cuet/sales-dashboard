<?php

class Order extends \Eloquent
{
    protected $fillable = [];

    public static $rules = [
        // 'title' => 'required'
    ];

    public static function orderAllowedCol($userType)
    {
        switch ($userType) {
            case 1: //for admin
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'sale_price', 'fee', 'amount_paid',
                    'outstanding', 'percent', 'profit', 'no_of_page');
                return $col;
                break;

            case 2: //for manager
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'fee');
                return $col;
                break;

            case 3: //for salesman
                $col = array('id', 'due_date', 'client', 'status', 'sale_price', 'amount_paid', 'outstanding');
                return $col;
                break;
        }
    }
}