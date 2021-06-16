<?php

namespace App\Models\Contracts;


abstract class BaseModel implements CrudInterface
{
    protected $connection;
    protected $table;
    protected $primaryKey = 'id';
    protected $pageSize = 10;
    protected $attributes = [];

    // public function __construct()
    // {
    //     # if mysql => set mysql connection
    // }

    public function getAttribute($property)
    {
        if (!$property || !array_key_exists($property, $this->attributes)) {
            return null;
        }
        return $this->attributes[$property];
    }

    public function getAttributes()
    {
        return $this->attributes;
    }


    public function __get($property)
    {
        return $this->getAttribute($property);
    }


    public function __set($property, $value)
    {
        if (!$property || !array_key_exists($property, $this->attributes))
            return null;

        return $this->attributes[$property] = $value;
    }
}
