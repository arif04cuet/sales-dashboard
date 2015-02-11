<?php

class Order extends \Eloquent
{
    protected $fillable = [];

    public static $rules = [
        // 'title' => 'required'
    ];

    public static function orderAllowedCol($userType)
    {

        $col = array();
        switch ($userType) {
            case 'Admin': //for admin
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'sale_price', 'fee', 'amount_paid',
                    'outstanding', 'percent', 'profit', 'no_of_page');
                break;

            case 'Manager': //for manager
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'fee');
                break;

            case 'Sales': //for salesman
                $col = array('id', 'due_date', 'client', 'status', 'sale_price', 'amount_paid', 'outstanding');
                break;
            case 'Writer':
                $col = array('id', 'due_date', 'client', 'status', 'sale_price', 'amount_paid', 'outstanding');
                break;
        }
        return $col;
    }

    public static function status($key = null)
    {
        $status = array(
            'TA' => 'the project has to be assigned to a writer',
            'AC' => 'after the project has been assigned, we are awaiting confirmation from the writer that they can complete the project',
            'IP' => 'in process – the project is in process and the writer is working on it',
            'QC' => 'the project has been sent to quality control to review',
            'AP' => 'awaiting payment from the client',
            'C' => 'the project is complete'
        );
    }

    //relations

    public function invitaions()
    {
        return $this->hasMany('Invitation');
    }


}