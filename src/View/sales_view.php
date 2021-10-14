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

        <div class="card mt-5">
            <div class="card-header">
                <h5>Product Sales</h5>
            </div>
            <div class="card-body">

                <!-- <a href="/product" class="btn btn-success mt-2 mb-3">Add Product</a> -->
                <!-- <button class="btn btn-primary mt-2 mb-3">Sell Product</button> -->
                <a href="/" class="btn btn-primary mt-2 mb-3">Products</a>
                <!-- <a href="/product/clear" class="btn btn-danger mt-2 mb-3">Clear Product</a> -->

                <?php
                    if (isset($message)) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $message; ?>
                        </div>
                <?php endif ?>

                <table class="tbl">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>

                    <?php

                        foreach ($data as $key => $val) : ?>
                        
                            <tr>
                                <td><?php echo $val->product; ?></td>
                                <td><?php echo $val->quantity; ?></td>
                                <td><?php echo $val->amount; ?></td>
                                <td><?php echo date("M d, Y h:i A", strtotime($val->date_created)); ?></td>
                            </tr>

                    <?php
                        endforeach
                    ?>

                </table>

                <?php
                    if (!isset($data) || count($data) == 0) : ?>
                        <div class="no-product">
                            <h5>No sales yet.</h5>
                        </div>
                <?php endif ?>
            </div> 
        </div>
    </div>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>