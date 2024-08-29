<?php include 'include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chair Collections - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .img {
            border-radius: 10px;
            height: 250px;
            
        }
    </style>

</head>


<body>

    <?php include 'include/navbar.html'; ?>


    <main class="container mt-4">
        <h3 class="mb-4 text-center">Chair Collections</h3>
        <div class="row">

            <?php
            // Assuming the database connection ($conn) is established

            // Fetch data from 'living' table for easy and rocking chairs
            $livingData = mysqli_query($conn, "SELECT living.*, living_images.image_path
    FROM living
    LEFT JOIN living_images ON living.id = living_images.furniture_id
    WHERE living.type IN ('Easy Chair', 'Rocking Chair') ORDER BY living.id DESC");

            // Fetch data from 'reading' table for reading and computer chairs
            $readingData = mysqli_query($conn, "SELECT reading.*, reading_images.image_path
    FROM reading
    LEFT JOIN reading_images ON reading.id = reading_images.furniture_id
    WHERE reading.type IN ('Reading Chair', 'Computer Chair')");

            // Fetch data from 'dining' table for dining chairs
            $diningData = mysqli_query($conn, "SELECT dinning.*, dinning_images.image_path
    FROM dinning
    LEFT JOIN dinning_images ON dinning.id = dinning_images.furniture_id
    WHERE dinning.type = 'Dining Chair'");

            // Fetch data from 'office' table for office chairs
            $officeData = mysqli_query($conn, "SELECT office.*, office_images.image_path
    FROM office
    LEFT JOIN office_images ON office.id = office_images.furniture_id
    WHERE office.type IN ('Swivel Chair', 'Visitor Chair', 'Waiting Chair')");

            // Function to structure product data
            function getProductsArray($data, $type)
            {
                $products = [];

                while ($row = mysqli_fetch_assoc($data)) {
                    $productId = $row['id'];

                    if (!isset($products[$productId])) {
                        $products[$productId] = [
                            'id' => $row['id'],
                            'name' => $row['name'],
                            'code' => $row['code'],
                            'price' => $row['price'],
                            'offer_price' => $row['offer_price'],
                            'images' => [],
                            'type' => $type // Set the product type
                        ];
                    }

                    if ($row['image_path']) {
                        $products[$productId]['images'][] = $row['image_path'];
                    }
                }

                return $products;
            }

            // Merge all product data
            $products = array_merge(
                getProductsArray($livingData, 'Easy Chair'),
                getProductsArray($readingData, 'Reading Chair'),
                getProductsArray($diningData, 'Dining Chair'),
                getProductsArray($officeData, 'Swivel Chair')
            );

            // Placeholder image function
            function getProductImage($product)
            {
                return !empty($product['images']) ? $product['images'][0] : 'placeholder.jpg';
            }
            ?>

            <?php
            // Optimized type mapping
            function mapChairTypeToCategory($chairType)
            {
                $typeMap = [
                    'Easy Chair' => 'living',
                    'Rocking Chair' => 'living',
                    'Reading Chair' => 'reading',
                    'Computer Chair' => 'reading',
                    'Dining Chair' => 'dinning',
                    'Swivel Chair' => 'office',
                    'Visitor Chair' => 'office',
                    'Waiting Chair' => 'office'
                ];

                return $typeMap[$chairType] ?? '';
            }

            // Display products
            foreach ($products as $product) {
                $type = mapChairTypeToCategory($product['type']);
            ?>
                <!-- Sample Bed Item -->
                <div class="col-6 col-md-3 mb-4">
                    <div class="card">
                        <?php if (!empty($type)) { ?>
                            <a href="product_details.php?type=<?php echo $type; ?>&id=<?php echo $product['id']; ?>">
                            <?php } ?>
                            <img src="image/<?php echo getProductImage($product); ?>" class="card-img-top img" alt="Product Image" loading="lazy">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $product['code']; ?>
                                </h5>


                                <?php
                                include 'include/price.php';
                                ?>



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