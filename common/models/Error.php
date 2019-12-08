<?php
/**
 * Error.php
 * atuthor: liuchg
 */

namespace common\models;


class Error extends LogicModel
{
    public function __construct($error='', $attribute='_logic')
    {
        if (is_array($error)) {
            $this->addErrors($error);
        } else {
            $this->addError($attribute, $error);
        }
    }

    public function isError($obj) {
        return ($obj instanceof self);
    }
}