<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title><?php echo $title; ?></title>

    <style>
        
    </style>
</head>
<body>
        
    <div class="container">
        <h2 class="mt-5">Stock Managemnet System</h2>
        
        <div class="card mt-5">
            <div class="card-header">
                <h5>Add Product</h5>
            </div>
            <div class="card-body">
                
                <?php
                    if (isset($message)) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $message; ?>
                        </div>
                <?php endif ?>

                <form action="/product/add">
                    <div class="form-group">
                        <label for="email">Product Name</label>
                        <input type="text" class="form-control" id="product" placeholder="Enter product name" name="product" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Stock</label>
                        <input type="text" class="form-control" id="stock" placeholder="Enter stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" placeholder="Enter price" name="price" required>
                    </div>
                    <a href="/" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>