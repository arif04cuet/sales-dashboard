<?php

/**
 * Created by PhpStorm.
 * User: Shahid
 * Date: 1/18/15
 * Time: 10:13 PM
 */
class Utility
{
    public static function createActionBtn($model)
    {
        return
            '<a href="writers/' . $model->id . '" title="View this item" class="btn btn-xs btn-primary btn-margin"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;</a>'
            . '<a href="writers/' . $model->id . '/edit" title="Edit this item" class="btn btn-xs btn-success btn-margin"><i class="glyphicon glyphicon-pencil"></i>&nbsp;</a>'
            . Form::open(array('url' => Config::get("syntara::config.uri") . '/writers/' . $model->id, 'class' => 'item-remove-form'))
            . Form::hidden('_method', 'DELETE')
            . '<button type="submit" title="Delete this item" class="btn remove_levels btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'
            . Form::close();
    }

    public static function test()
    {
        return 'ok';
    }
} 