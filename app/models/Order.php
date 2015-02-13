<?php

class Order extends \Eloquent
{
    protected $fillable = [];

    public static $rules = [
        // 'title' => 'required'
    ];

    public static function orderAllowedCol($userType, $few = true)
    {

        $col = array();
        switch ($userType) {
            case 'Admin': //for admin
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'sale_price', 'fee', 'amount_paid',
                    'outstanding', 'percent', 'profit', 'no_of_page', 'product_name', 'instructions', 'course_outline', 'lecture_notes', 'additional_materials');
                break;

            case 'Manager': //for manager
                $col = array('id', 'due_date', 'client', 'writer', 'status', 'fee', 'product_name', 'instructions', 'course_outline', 'lecture_notes', 'additional_materials');
                break;

            case 'Sales': //for salesman
                $col = array('id', 'due_date', 'client', 'status', 'sale_price', 'amount_paid', 'outstanding', 'product_name', 'instructions', 'course_outline', 'lecture_notes');
                break;
            case 'Writer':
                $col = array('id', 'due_date', 'client','writer', 'status', 'sale_price', 'amount_paid', 'outstanding', 'product_name', 'instructions', 'course_outline', 'lecture_notes');
                break;
            case 'QC':
                $col = array('id', 'due_date', 'client', 'status', 'sale_price', 'amount_paid', 'outstanding', 'product_name', 'instructions', 'course_outline', 'lecture_notes');
                break;
        }
        if ($few)
            $col = array_slice($col, 0, 12);
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

    public function invitations()
    {
        return $this->hasMany('Invitation');
    }

    public function documents()
    {
        return $this->hasMany('Document');
    }

    public function isAcceptedBy($userType)
    {
        $flag = false;
        $order = $this;
        switch (strtolower($userType)) {
            case 'writer':
                $flag = Invitation::with(array('order' => function ($query) use ($order) {
                    return $query->where('id', $order->id);
                }))->where('status', '=', 1)->get()->count();
                return !$flag;
                break;
            case 'qc':
                $flag = Invitation::with(array('order' => function ($query) use ($order) {
                    return $query->where('id', $order->id);
                }))->where('status', '=', 1)->get()->count();
                return $flag;
                break;
        }
        return $flag;
    }
}