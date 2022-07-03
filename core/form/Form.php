<?php

namespace app\core\form;
use app\core\Model;

class Form 
{
    public static function begin($action, $method)
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function beginWithImage($action, $method)
    {
        echo sprintf('<form action="%s" method="%s" enctype="multipart/form-data">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

    public function selectField(Model $model, $attribute, $values)
    {
        return new SelectField($model, $attribute, $values);
    }
}