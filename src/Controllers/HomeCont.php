<?php

namespace SMS\Controllers;

use SMS\Models\Product;
use SMS\Models\Sales;

class HomeCont {

    private $productModel;
    private $salesModel;

    public function __construct() 
    {
        $this->productModel = new Product();
        $this->salesModel = new Sales();
    }

    public function loadHome()
    {
        $products = $this->productModel->getAll();
        $totalSales = $this->salesModel->getTotalSale();

        $totalSales = $totalSales == null ? 0 : $totalSales;

        view('home_view', [
            'title' => 'Home',
            'sales' => $totalSales,
            'data' => $products
        ]);
    }
}