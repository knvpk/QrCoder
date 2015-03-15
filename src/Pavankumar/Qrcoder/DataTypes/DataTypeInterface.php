<?php namespace Pavankumar\Qrcoder\DataTypes;

interface DataTypeInterface
{
    public function create(Array $arguments);

    public function __toString();

}