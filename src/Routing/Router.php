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

        // dd($_SERVER);

        if ($pathArr[1] == 'api') {

            switch ($pathArr[2]) {
                case 'product' :
                    $prodCont = new ProductCont();

                    if (count($pathArr) > 3) {
                        
                        switch($pathArr[3]) {
                            case 'update':
                                $prodCont->updateAPI($this->parseQuery($query));
                                break;
                            case 'sell':
                                $prodCont->sellAPI($this->parseQuery($query));
                                break;
                            default:
                                $this->apiError404();
                                break;
                        }

                    }
                
                    break;

                default:
                    // $this->apiError404();
                    break;
            }

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
                            case 'clear':
                                $prodCont->clear();
                                break;
                            case 'sales':
                                $prodCont->loadSalesView();
                                break;
                            default:
                                $this->error404();
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
    private function apiError404()
    {
        echo json_encode([
            "status" => false,
            "code" => 404,
            "message" => 'Error 404: Resource not found.'
        ]);
    }

    private function parseQuery($queryStr)
    {
        $postData = $_SERVER['REQUEST_METHOD'] == 'POST' ? json_decode(file_get_contents('php://input')) : null;
        return new Request($queryStr, $postData);
    }
}