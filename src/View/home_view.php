<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?php echo $title; ?></title>

    <style>

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .no-product {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px;
            width: 100%;
        }

    </style>

</head>
<body>

    <div class="container">
        <h2 class="mt-5">Stock Managemnet System</h2>

        <a href="/product/clear" class="btn btn-danger mt-2">Clear Database</a>

        <div class="card mt-4">
            <div class="card-header">
                <h5>Products</h5>
            </div>
            <div class="card-body">

                <a href="/product" class="btn btn-success mt-2 mb-3">Add Product</a>
                <!-- <a href="/product/clear" class="btn btn-danger mt-2 mb-3">Clear Product</a> -->
                <!-- <button class="btn btn-primary mt-2 mb-3">Sell Product</button> -->
                <a href="/product/sales" class="btn btn-primary mt-2 mb-3">Sales</a>

                <h5 style="float:right">Total Sales: <?php echo $sales; ?></h5>

                <?php
                    if (isset($message)) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $message; ?>
                        </div>
                <?php endif ?>

                <table class="tbl">
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>

                    <?php

                        foreach ($data as $key => $val) : ?>
                        
                            <tr>
                                <td><?php echo $val->product; ?></td>
                                <td><?php echo $val->stock; ?></td>
                                <td><?php echo $val->price; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success" onclick='setSelectedProduct(<?php echo json_encode($val); ?>)' data-toggle="modal" data-target="#sellProductModal">Sell</button>
                                        <button type="button" class="btn btn-sm btn-primary" onclick='setSelectedProduct(<?php echo json_encode($val); ?>)' data-toggle="modal" data-target="#updateProductModal">Update</button>
                                        <!-- <button type="button" class="btn btn-sm btn-danger">Delete</button> -->
                                    </div>
                                </td>
                            </tr>

                    <?php
                        endforeach
                    ?>

                </table>

                <?php
                    if (!isset($data) || count($data) == 0) : ?>
                        <div class="no-product">
                            <h5>No product yet.</h5>
                        </div>
                <?php endif ?>
            </div> 
        </div>
    </div>



    <!-- Update Product Modal -->
    <div id="updateProductModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="email">Product Name</label>
                        <input type="text" class="form-control" id="product" placeholder="Enter product name" name="product" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Stock</label>
                        <input type="number" class="form-control" id="stock" placeholder="Enter stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button style="min-width: 100px" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button style="min-width: 100px" id="btnSave" type="button" class="btn btn-primary" onclick="updateProduct()">Save</button>
            </div>
            </div>

        </div>
    </div>

    <!-- Sell Product Modal -->
    <div id="sellProductModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sell Product</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="email">Product Name</label>
                        <input type="text" class="form-control" id="sell_product" name="sell_product" disabled>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Available Stock(s)</label>
                        <input type="number" class="form-control" id="sell_stock" name="sell_stock" disabled>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="sell_price" name="sell_price" disabled>
                    </div>
                    <div class="form-group">
                        <label for="price">Quantity</label>
                        <input type="number" class="form-control" id="sell_quantity" name="sell_quantity" placeholder="Enter quantity">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button style="min-width: 100px" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button style="min-width: 100px" id="btnSell" type="button" class="btn btn-primary" onclick="sellProduct()">Sell</button>
            </div>
            </div>

        </div>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>

        var selectedProduct = null;

        function setSelectedProduct(product) {
            selectedProduct = product;
            console.log(product);
        }

        $(document).on('show.bs.modal', '#updateProductModal', function (e) {
            $('#product').val(selectedProduct.product);
            $('#stock').val(selectedProduct.stock);
            $('#price').val(selectedProduct.price);
        });

        $(document).on('hide.bs.modal', '#updateProductModal', function (e) {
            selectedProduct = null;
        });

        $(document).on('show.bs.modal', '#sellProductModal', function (e) {
            $('#sell_product').val(selectedProduct.product);
            $('#sell_stock').val(selectedProduct.stock);
            $('#sell_price').val(selectedProduct.price);
        });

        $(document).on('hide.bs.modal', '#sellProductModal', function (e) {
            selectedProduct = null;
        });

        function updateProduct() {

            if ( $('#btnSave').text() === 'Loading...') return;

            selectedProduct.product = $('#product').val();
            selectedProduct.stock = $('#stock').val();
            selectedProduct.price = $('#price').val();

            $('#btnSave').text('Loading...')
        
            const response = fetch('/api/product/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(selectedProduct) // body data type must match "Content-Type" header
            })
            .then(response => response.json())
            .then(data => {
                $('#btnSave').text('Save');
                location.reload();
            })
            .catch((error) => {
                $('#btnSave').text('Save')
            });
        }

        function updateProduct() {

            if ( $('#btnSave').text() === 'Loading...') return;

            selectedProduct.product = $('#product').val();
            selectedProduct.stock = $('#stock').val();
            selectedProduct.price = $('#price').val();

            $('#btnSave').text('Loading...')
        
            const response = fetch('/api/product/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(selectedProduct) // body data type must match "Content-Type" header
            })
            .then(response => response.json())
            .then(data => {
                $('#btnSave').text('Save');
                location.reload();
            })
            .catch((error) => {
                $('#btnSave').text('Save')
            });
        }

        function sellProduct() {

            if ( $('#btnSell').text() === 'Selling...') return;
           
            $('#btnSell').text('Selling...')

            const response = fetch('/api/product/sell', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "product_id": selectedProduct.id,
                    "quantity": $('#sell_quantity').val()
                }) // body data type must match "Content-Type" header
            })
            .then(response => response.json())
            .then(data => {
                $('#btnSell').text('Sell');
                location.reload();
            })
            .catch((error) => {
                $('#btnSell').text('Sell')
            });
        }
        
    </script>
</body>
</html>