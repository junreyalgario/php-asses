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

    </style>
</head>
<body>

    <div class="container">
        <h2 class="mt-5">Stock Managemnet System</h2>

        <div class="card mt-5">
            <div class="card-header">
                <a href="/product" class="btn btn-success mt-2 mb-3">Add Product</a>
                <button class="btn btn-primary mt-2 mb-3">Sell Product</button>
            </div>
            <div class="card-body">
            <table class="tbl">
                <tr>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Price</th>
                </tr>

                <?php

                    foreach ($data as $key => $val) : ?>
                    
                        <tr>
                            <td><?php echo $val->product; ?></td>
                            <td><?php echo $val->stock; ?></td>
                            <td><?php echo $val->price; ?></td>
                        </tr>

                <?php
                    endforeach
                ?>

            </table>
            </div> 
        </div>
    </div>

</body>
</html>