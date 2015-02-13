<?php

/**
 * Created by PhpStorm.
 * User: Shahid
 * Date: 1/18/15
 * Time: 10:13 PM
 */
class Utility
{
    public static function createActionBtn($model, $route)
    {
        return
            '<a href="' . URL::route('Show' . $route, array('id' => $model->id)) . '" title="View this item" class="btn btn-xs btn-primary btn-margin">
<i class="glyphicon glyphicon-eye-open"></i>&nbsp;</a>'
            . '<a href="' . URL::route('Edit' . $route, array('id' => $model->id)) . '" title="Edit this item" class="btn btn-xs btn-success btn-margin">
<i class="glyphicon glyphicon-pencil"></i>&nbsp;</a>'
            . Form::open(array('url' => URL::route('Delete' . $route, array('id' => $model->id)), 'class' => 'item-remove-form'))
            . Form::hidden('_method', 'DELETE')
            . '<button type="submit" title="Delete this item" class="btn remove_levels btn-xs btn-danger">
<i class="glyphicon glyphicon-trash"></i>&nbsp;</button>'
            . Form::close();
    }

    public static function getUserType()
    {
        $groups = Sentry::getUser()->getGroups()->toArray();
        return $groups[0]['name'];

    }

    public static function underscoreToSpace(array $data)
    {
        return array_map(function ($value) {
            return ucfirst(str_replace('_', ' ', $value));
        }, $data);
    }

    public static function getUserGroup()
    {
        $groups = Sentry::getUser()->getGroups()->toArray();
        return $groups[0]['name'];
    }

    public static function userIs($userType)
    {
        return strtolower(self::getUserGroup()) == strtolower($userType);
    }
} 