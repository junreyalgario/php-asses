<?php

namespace SMS\Controllers;

use SMS\Models\Product;
use SMS\Routing\Request;

class ProductCont {

    private $productModel;

    public function __construct() 
    {
        $this->productModel = new Product();
    }

    public function loadAddView()
    {
        view('add_stock_view', [
            'title' => 'Add Product'
        ]);
    }

    public function add(Request $request) 
    {
        $this->productModel->add(
            $request->query('product'), 
            $request->query('stock'),
            $request->query('price')
        );

        view('add_stock_view', [
            'title' => 'Add Product',
            'message' => 'Product successfully added!'
        ]);
    }

}