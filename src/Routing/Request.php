<?php

namespace SMS\Routing;

class Request {

    private $query = [];
    private $post = [];

    public function __construct($queryString, $postData)
    {
        parse_str($queryString, $this->query);
        $this->post = $postData;
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

    public function post($name)
    {
        foreach ($this->post as $key => $value) {
            if ($name == $key) {
                return $value;
            }
        }
        
        return null;
    }

}