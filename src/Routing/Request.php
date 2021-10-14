<?php

namespace SMS\Routing;

class Request {

    private $query = [];

    public function __construct($queryString)
    {
        parse_str($queryString, $this->query);
    }

    public function query($name)
    {
        foreach ($this->query as $key => $value) {
            if ($name == $key) {
                return $value;
            }
        }
        
        return null;
    }

}