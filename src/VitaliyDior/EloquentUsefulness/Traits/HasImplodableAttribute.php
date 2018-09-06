<?php
/**
 * Created by PhpStorm.
 * User: vitaliy
 * Date: 06.09.18
 * Time: 12:06
 */

namespace VitaliyDior\EloquentUsefulness\Traits;


trait HasImplodableAttribute
{


    /**
     * Get glue from implode list of values for attribute
     *
     * @return string
     */
    public function getImplodeDelimiter()
    {
        return defined('static::DELIMITER') ? static::DELIMITER : '|';
    }


    protected function getListedAttribute($value)
    {
        return (! is_null($value)) ?
            explode($this->getImplodeDelimiter(), $value) :
            [];
    }

    protected function setListedAttribute($attribute, $value)
    {
        if (! is_null($value)) {
            $this->attributes[$attribute] = ((is_array($value) && count($value)>0)) ?
                trim(implode($this->getImplodeDelimiter(), $value), $this->getImplodeDelimiter()) :
                null;
        } else {
            $this->attributes[$attribute] = null;
        }
    }

}