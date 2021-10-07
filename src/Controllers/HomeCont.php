<?php

namespace SMS\Controllers;

use SMS\Models\Product;

class HomeCont {

    private $productModel;

    public function __construct() 
    {
        $this->productModel = new Product();
    }

    public function loadHome()
    {
        $products = $this->productModel->getAll();

        view('home_view', [
            'title' => 'Home',
            'data' => $products
        ]);
    }
}