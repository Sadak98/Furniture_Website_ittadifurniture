<?php include 'include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bed Collections - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .img {
            border-radius: 10px;
            height: 180px;
            
        }
    </style>
</head>


<body>

    <?php include 'include/navbar.html'; ?>


    <main class="container mt-4">
        <h3 class="mb-4 text-center">Bed Collections</h3>
        <div class="row">
            <?php
            // Fetch data from 'bedroom' table for beds
            $bedroomData = mysqli_query($conn, "SELECT bedroom.*, bedroom_images.image_path
                                            FROM bedroom
                                            LEFT JOIN bedroom_images ON bedroom.id = bedroom_images.furniture_id
                                            WHERE bedroom.type='bed' ORDER BY bedroom.id DESC");

            // Fetch data from 'living' table for Sofa Cum Beds
            $livingData = mysqli_query($conn, "SELECT living.*, living_images.image_path
                                           FROM living
                                           LEFT JOIN living_images ON living.id = living_images.furniture_id
                                           WHERE living.type='Sofa Cum Bed' ORDER BY living.id DESC");

            // Merge both sets of data into a single array
            $products = array_merge(getProductsArray($bedroomData, 'bed'), getProductsArray($livingData, 'Sofa Cum Bed'));

            // Function to structure product data
            function getProductsArray($data, $type)
            {
                $products = array(); // Array to store product details

                global $conn;

                while ($row = mysqli_fetch_assoc($data)) {
                    $productId = $row['id'];

                    if (!isset($products[$productId])) {
                        $products[$productId] = [
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'code' => $row['code'],
                            'price' => $row['price'],
                            'offer_price' => $row['offer_price'],
                            'images' => array(),
                            'type' => $type // Set the product type
                        ];
                    }

                    if ($row['image_path']) {
                        $products[$productId]['images'][] = $row['image_path'];
                    }
                }

                return $products;
            }

            // Display products
            foreach ($products as $product) {
            ?>
                <!-- Sample Bed Item -->
                <div class="col-6 col-md-3 mb-4">
                    <div class="card">

                        <?php
                        if (isset($product['type']) && strpos($product['type'], 'bed') !== false) {
                        ?>
                            <a href="product_details.php?type=bedroom&id=<?php echo $product['id']; ?>">
                            <?php
                        } elseif (isset($product['type']) && strpos($product['type'], 'Sofa Cum Bed') !== false) {
                            ?>
                                <a href="product_details.php?type=living&id=<?php echo $product['id']; ?>">
                                <?php
                            }
                                ?>
                                <?php if (!empty($product['images'])) { ?>
                                    <img src="<?php echo $product['images'][0]; ?>" class="card-img-top img" alt="Product Image" loading="lazy">
                                <?php } else { ?>
                                    <img src="placeholder.jpg" class="card-img-top img" alt="Placeholder Image" loading="lazy">
                                <?php } ?>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $product['code']; ?>
                                    </h5>




                                    <?php include 'include/price.php'; ?>




                                </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>










    <!-- FOOTER -->
    <?php include 'include/footer.html'; ?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/drop.js"></script>
</body>

</html>