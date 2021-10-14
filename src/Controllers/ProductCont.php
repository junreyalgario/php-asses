<?php

namespace SMS\Controllers;

use SMS\Models\Product;
use SMS\Models\Sales;
use SMS\Routing\Request;

class ProductCont {

    private $productModel;
    private $salesModel;

    public function __construct() 
    {
        $this->productModel = new Product();
        $this->salesModel = new Sales();
    }

    public function loadAddView()
    {
        view('add_stock_view', [
            'title' => 'Add Product'
        ]);
    }

    public function loadSalesView()
    {
        $sales = $this->salesModel->getAll();
        view('sales_view', [
            'title' => 'Home',
            'data' => $sales
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
            'message' => 'Product has been successfully added!'
        ]);
    }

    public function clear()
    {
        $this->productModel->clear();
        $this->salesModel->clear();
        $totalSales = $this->salesModel->getTotalSale();
        $totalSales = $totalSales == null ? 0 : $totalSales;

        view('home_view', [
            'title' => 'Home',
            'sales' => $totalSales,
            'data' => [],
            'message' => 'Database has been successfully cleared!'
        ]);
    }

    // Product API
    public function updateAPI(Request $request)
    {
        $this->productModel->update([
            ":id" => $request->post('id'),
            ":product" => $request->post('product'),
            ":stock" => $request->post('stock'),
            ":price" => $request->post('price')
        ]);

        jsonResp(true, 200, null, 'Product has been successfully updated!');
    }

    public function sellAPI(Request $request)
    {
        $productId = $request->post('product_id');
        $qntty = $request->post('quantity');
        $product = $this->productModel->find('id', $productId)[0];
        
        if ($qntty <= $product->stock) {
            $amount = $product->price * $qntty;
            $this->salesModel->add($productId, $qntty, $amount);
            $this->productModel->update([
                ":id" => $product->id,
                ":product" => $product->product,
                ":stock" => $product->stock - $qntty,
                ":price" => $product->price
            ]);

            jsonResp(true, 200, null, 'Product has been sold successfully!');
        } else {
            jsonResp(false, 200, null, 'Product quantity must be less than the number of available stocks!');
        }
    }

}