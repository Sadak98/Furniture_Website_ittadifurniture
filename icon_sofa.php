<?php include 'include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sofa Collections - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .img {
            border-radius: 10px;
            height: 150px;
            
        }
    </style>

</head>


<body>


    <?php include 'include/navbar.html'; ?>


    <main class="container mt-4">
        <h3 class="mb-4 text-center">Sofa Collections</h3>
        <div class="row">
            <?php
            // Fetch data from 'living' table for sofa
            $livingData1 = mysqli_query($conn, "SELECT living.*, living_images.image_path
                                            FROM living
                                            LEFT JOIN living_images ON living.id = living_images.furniture_id
                                            WHERE living.type='Sofa'");

            // Fetch data from 'living' table for Sofa Cum Bed
            $livingData2 = mysqli_query($conn, "SELECT living.*, living_images.image_path
                                           FROM living
                                           LEFT JOIN living_images ON living.id = living_images.furniture_id
                                           WHERE living.type='Sofa Cum Bed'");

            // Fetch data from 'office' table for waiting chair
            $officeData = mysqli_query($conn, "SELECT office.*, office_images.image_path
                                           FROM office
                                           LEFT JOIN office_images ON office.id = office_images.furniture_id
                                           WHERE office.type='Waiting Sofa'");

            // Merge both sets of data into a single array
            $products = array_merge(getProductsArray($livingData1, 'Sofa'), getProductsArray($livingData2, 'Sofa Cum Bed'), getProductsArray($officeData, 'Waiting Sofa'));

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
                        if (isset($product['type'])) {
                            switch ($product['type']) {
                                case 'Sofa':
                                case 'Sofa Cum Bed':
                                    $type = 'living';
                                    break;
                                case 'Waiting Sofa':
                                    $type = 'office';
                                    break;
                                default:
                                    $type = ''; // Handle other cases if needed
                                    break;
                            }

                            if (!empty($type)) {
                        ?>
                                <a href="product_details.php?type=<?php echo $type; ?>&id=<?php echo $product['id']; ?>">
                            <?php
                            }
                        }
                            ?>
                            <?php if (!empty($product['images'])) { ?>
                                <img src="image/<?php echo $product['images'][0]; ?>" class="card-img-top img" alt="Product Image" loading="lazy">
                            <?php } else { ?>
                                <img src="placeholder.jpg" class="card-img-top img" alt="Placeholder Image" loading="lazy">
                            <?php } ?>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $product['code']; ?>
                                    </h5>


                                    <?php
                                    include 'include/price.php';?>


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