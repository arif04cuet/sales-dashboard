<?php

/**
 * Created by Arif Hossain.
 * Date: 1/1/15
 * Time: 5:15 PM
 */
class EloquentOrderRepository implements OrderRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

}