<?php include 'include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Chair Collections - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">

</head>


<body>

<?php include 'include/navbar.html'; ?>


    <main class="container mt-0">

        <h3 class="mb-4 text-center">Visitor Chair Collections</h3>
        <div class="row">
            <?php
            $allData = mysqli_query($conn, "SELECT office.*, office_images.image_path
                                            FROM office
                                            LEFT JOIN office_images ON office.id = office_images.furniture_id
                                            WHERE office.type='Visitor Chair' ORDER BY office.id DESC");

            $products = array(); // Array to store product details

            while ($row = mysqli_fetch_assoc($allData)) {
                $productId = $row['id'];

                // If the product is not yet added to the array, add it
                if (!isset($products[$productId])) {
                    $products[$productId] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'code' => $row['code'],
                        'price' => $row['price'],
                        'offer_price' => $row['offer_price'],
                        'images' => array() // Array to store images
                    ];
                }

                // Add image paths to the product's image array
                if ($row['image_path']) {
                    $products[$productId]['images'][] = $row['image_path'];
                }
            }

            // Iterate through each product to display the first image
            foreach ($products as $product) {
            ?>
                <!-- Sample Bed Item -->
                <div class="col-6 col-md-3 mb-4">
                    <div class="card">
                        <a href="product_details.php?type=office&id=<?php echo $product['id']; ?>">
                            <?php if (!empty($product['images'])) { ?>
                                <img src="<?php echo $product['images'][0]; ?>" class="card-img-top" alt="Product Image" loading="lazy">
                            <?php } else { ?>
                                <img src="placeholder.jpg" class="card-img-top" alt="Placeholder Image" loading="lazy">
                            <?php } ?>
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo $product['code']; ?>
                            </h5>
                            <!-- ///Price Container/// -->
                            <?php
                            include 'include/price.php';
                            ?>

                            <!-- ///Price Container//// -->
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>

    <?php
    include 'include/footer.html';
    ?>



    <script src="js/drop.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>