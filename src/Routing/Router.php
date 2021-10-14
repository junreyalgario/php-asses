<?php

namespace SMS\Routing;

use SMS\Routing\Request;
use SMS\Controllers\ErrorCont;
use SMS\Controllers\HomeCont;
use SMS\Controllers\ProductCont;

class Router {

    public function __construct()
    {

    }

    public function serve()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $request = $_SERVER['REQUEST_URI'];
        $pathArr =  explode('/', $requestUri['path']);

        $query = isset($requestUri['query']) ? $requestUri['query'] : '';

        // dd($requestUri);

        if ($pathArr[1] == 'api') {

        } else {
            switch ($pathArr[1]) {
                case '' :
                case '/' :
                    $home = new HomeCont();
                    $home->loadHome();
                    break;

                case 'product' :
                    $prodCont = new ProductCont();

                    if (count($pathArr) > 2) {
                        
                        switch($pathArr[2]) {
                            case 'add':
                                $prodCont->add($this->parseQuery($query));
                                break;
                        }

                    } else {
                        $prodCont->loadAddView();
                    }
                
                    break;

                default:
                    $this->error404();
                    break;
            }
        }
    }

    private function error404()
    {
        $errorCont = new ErrorCont();
        http_response_code(404);
        $errorCont->error404();
    }

    private function parseQuery($queryStr)
    {
        return new Request($queryStr);
    }
}