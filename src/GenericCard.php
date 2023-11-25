<?php
namespace Trump;

class GenericCard
{
    protected $value;
    
    public function __construct($value)
    {
        $this->value = $value;
    }
}
