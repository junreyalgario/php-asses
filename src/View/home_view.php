<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <style>

        .tbl td {
            min-width: 100px;
        }

    </style>
</head>
<body>

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
                    <td><?php echo $val->prize; ?></td>
                </tr>

        <?php
            endforeach
        ?>

    </table>
    
</body>
</html>