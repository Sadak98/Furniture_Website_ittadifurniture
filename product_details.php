<?php
include 'include/config.php';



function fetchProductData($conn, $productTable, $productId)
{
    $productQuery = "SELECT * FROM `$productTable` WHERE id = ?";
    $productStmt = mysqli_prepare($conn, $productQuery);
    mysqli_stmt_bind_param($productStmt, "i", $productId);
    mysqli_stmt_execute($productStmt);
    return mysqli_stmt_get_result($productStmt);
}

function fetchProductImages($conn, $imageTable, $productId)
{
    $imagesQuery = "SELECT * FROM `$imageTable` WHERE furniture_id = ?";
    $imagesStmt = mysqli_prepare($conn, $imagesQuery);
    mysqli_stmt_bind_param($imagesStmt, "i", $productId);
    mysqli_stmt_execute($imagesStmt);
    return mysqli_stmt_get_result($imagesStmt);
}

function fetchProductReviews($conn, $reviewTable, $productId)
{
    $reviewsQuery = "SELECT * FROM `$reviewTable` WHERE product_id = ? ORDER BY created_at DESC";
    $reviewsStmt = mysqli_prepare($conn, $reviewsQuery);
    mysqli_stmt_bind_param($reviewsStmt, "i", $productId);
    mysqli_stmt_execute($reviewsStmt);
    return mysqli_stmt_get_result($reviewsStmt);
}

if (isset($_GET['type'], $_GET['id'])) {
    $type = $_GET['type'];
    $productId = $_GET['id'];

    $validTypes = [
        'bedroom' => ['product' => 'bedroom', 'image' => 'bedroom_images', 'review' => 'bedroom_reviews'],
        'living' => ['product' => 'living', 'image' => 'living_images', 'review' => 'living_reviews'],
        'dinning' => ['product' => 'dinning', 'image' => 'dinning_images', 'review' => 'dinning_reviews'],
        'reading' => ['product' => 'reading', 'image' => 'reading_images', 'review' => 'reading_reviews'],
        'office' => ['product' => 'office', 'image' => 'office_images', 'review' => 'office_reviews'],
        'others' => ['product' => 'others', 'image' => 'others_images', 'review' => 'others_reviews']
    ];

    // Check if the provided type exists in validTypes
    if (array_key_exists($type, $validTypes)) {
        $productTable = $validTypes[$type]['product'];
        $imageTable = $validTypes[$type]['image'];
        $reviewTable = $validTypes[$type]['review'];

        $productData = fetchProductData($conn, $productTable, $productId);

        if ($productData && mysqli_num_rows($productData) > 0) {
            $product = mysqli_fetch_assoc($productData);
            $imagesData = fetchProductImages($conn, $imageTable, $productId);
            $reviewsData = fetchProductReviews($conn, $reviewTable, $productId);

            if ($imagesData && mysqli_num_rows($imagesData) > 0) {
                // Use $imagesData to display thumbnail images in HTML
            } else {
                $noImagesMsg = "No images found for this product!";
            }
        } else {
            $productNotFoundMsg = "Product not found!";
        }
    } else {
        $invalidTypeMsg = "Invalid product type!";
    }
} else {
    $invalidRequestMsg = "Invalid request!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Ityadi Furniture</title>
    <link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="..."> <!-- This link might change, refer to Font Awesome documentation -->

</head>

<body>

    <?php include 'include/navbar.html'; ?>

    <main class="container mt-0">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="position-relative">
                    <?php
                    if ($imagesData && mysqli_num_rows($imagesData) > 0) {
                        $mainImage = mysqli_fetch_assoc($imagesData); // Fetch the main image separately
                    ?>
                        <img src="<?php echo $mainImage['image_path']; ?>" class="d-block w-100 bed-image"
                            alt="<?php echo $product['name']; ?>" id="mainImage"
                            onclick="showFullScreen('<?php echo $mainImage['image_path']; ?>')">
                    <?php
                    } else {
                        echo "Main image not found!";
                    }
                    ?>
                </div>

                <div class="mt-4">
                    <?php
                    $imagesData = mysqli_query($conn, "SELECT * FROM `$imageTable` WHERE furniture_id = $productId");

                    if ($imagesData && mysqli_num_rows($imagesData) > 0) {
                        while ($image = mysqli_fetch_assoc($imagesData)) {
                    ?>
                            <img src="<?php echo $image['image_path']; ?>" class="thumbnail-img mt-2" alt="Product Image"
                                onclick="setAsMainImage(this)">
                    <?php
                        }
                    } else {
                        echo "No images found for this product!";
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-6 mb-4 custom-container">
                <h2>
                    <b>
                        <?php echo $product['name']; ?>
                    </b>
                </h2>
                <h3><b> Code:</b>
                    <?php echo $product['code']; ?>
                </h3>
                <?php
$price = $product['price'];
$o_price = isset($product['offer_price']) ? $product['offer_price'] : null;


                // Check if the offer price is set and less than the original price
                if ($o_price && $o_price <= $price) {
    $discount_percentage = (($price - $o_price) / $price) * 100;
?>
    <div class="price-containerP">
        <h3>
            <span class="amount">৳<?php echo $o_price; ?></span> <br>
            <span class="original-price"style="font-size: 17px;">৳<?php echo $price; ?></span>
            <span class="discount-percentage"style="font-size: 17px;">
            <?php echo number_format(-$discount_percentage,2);?>%
            </span>
        </h3>
    </div>
<?php
} else {
?>
    <div class="price-containerP">
        <span class="no-offer">৳<?php echo $price?></span>
    </div>
<?php
}

                ?>

                <br>
                <hr>
                <p><b> Type: </b>
                    <?php echo $product['type']; ?>
                </p>
                <p><b> Materials: </b>
                    <?php echo $product['material']; ?>
                </p>
                <p><b> Size:</b>
                    <?php echo $product['size']; ?>
                </p>
                <p><b> Details:</b> <br>

                    <?php echo nl2br($product['information']); ?>
                </p>
            </div>
        </div>

        <!-- Separate section for displaying reviews -->
        <hr> <!-- Horizontal line separating product and reviews -->

        <div class="row">
            <div class="col-md-12">
                <h2>Reviews</h2> <!-- Heading for the reviews section -->
            </div>
        </div>

        <div class="row reviews-section custom-container">
            <div class="col-md-12 mb-5">
                <!-- Displaying reviews -->
                <?php
                if (isset($reviewsData) && mysqli_num_rows($reviewsData) > 0) {
                    while ($review = mysqli_fetch_assoc($reviewsData)) {
                        // Display review details
                        echo "<p class='mt-0'>{$review['user_name']} says: {$review['review_text']}</p>";

                        echo "<p class='ratting'>Rating: ";
                        $rating = intval($review['rating']);
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $rating) {
                                echo "<span class='star-filled'>&#9733;</span>"; // Filled star
                            } else {
                                echo "<span class='star-empty'>&#9734;</span>"; // Empty star
                            }
                        }
                        echo "</p>";
                        // Display timestamp
                        $timestamp = strtotime($review['created_at']);
                        echo date('F j, Y, g:i a', $timestamp);




                        // Display review images as smaller thumbnails
                        $reviewImagesTable = $type . '_review_images'; // Constructing table name dynamically

                        $reviewImages = mysqli_query($conn, "SELECT * FROM $reviewImagesTable WHERE review_id = {$review['id']}");

                        if ($reviewImages && mysqli_num_rows($reviewImages) > 0) {
                            echo '<div class="review-images-container">';
                            while ($image = mysqli_fetch_assoc($reviewImages)) {
                                echo "<img src='{$image['image_path']}' alt='Review Image' class='review-thumbnail' onclick='showFullScreen(\"{$image['image_path']}\")'>";
                            }
                            echo '</div>';
                        }
                        echo '<hr>';
                    }
                } else {
                    echo "<p>No reviews found for this product.</p>";
                }
                ?>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 mb-4">
                <h2>Write a Review</h2>

                <form action="submit_review.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <div id="rating" class="rating">



                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="5 stars">&#9733;</label>
                            <input type="radio" id="star4" name="rating" value="4" required>
                            <label for="star4" title="4 stars">&#9733;</label>
                            <input type="radio" id="star3" name="rating" value="3" required>
                            <label for="star3" title="3 stars">&#9733;</label>
                            <input type="radio" id="star2" name="rating" value="2" required>
                            <label for="star2" title="2 stars">&#9733;</label>
                            <input type="radio" id="star1" name="rating" value="1" required>
                            <label for="star1" title="1 star">&#9733;</label>
                        </div>
                        <div class="invalid-feedback">Please provide a rating.</div>
                    </div>

                    <div class="form-group">

                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <input type="hidden" name="product_type" value="<?php echo $productTable; ?>">
                        <input type="text" name="user_name" class="form-control" placeholder="Your Name" required>

                        <div class="invalid-feedback">Please provide your name.</div>
                    </div>

                    <div class="form-group">
                        <textarea name="review_text" class="form-control" placeholder="Your Review" required></textarea>
                        <div class="invalid-feedback">Please write your review.</div>
                    </div>



                    <div class="form-group">
                        <label for="reviewImages">Upload Images:</label>
                        <input type="file" name="review_images[]" id="reviewImages" class="form-control-file" required
                            multiple>
                    </div>

                    <button type="submit" class="btn btn-danger">Submit Review</button>
                </form>
            </div>
        </div>

    </main>

    <!-- Footer from index page -->
    <?php include 'include/footer.html'; ?>

    <!-- Full-Screen Modal -->
    <div class="modal fade" id="fullScreenModal" tabindex="-1" role="dialog" aria-labelledby="fullScreenModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="fullScreenImage" onclick="closeFullScreen()">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and custom scripts -->

    <script>
        function setAsMainImage(thumbnail) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = thumbnail.src;
            mainImage.setAttribute('onclick', `showFullScreen('${thumbnail.src}')`);

            // Remove border from all thumbnail images
            const thumbnailImages = document.querySelectorAll('.thumbnail-img');
            thumbnailImages.forEach(img => img.classList.remove('selected-thumbnail'));

            // Add border to the clicked thumbnail
            thumbnail.classList.add('selected-thumbnail');
        }


        function showFullScreen(imagePath) {
            const modalImage = document.getElementById('fullScreenImage');
            modalImage.src = imagePath;
            $('#fullScreenModal').modal('show');
        }

        function closeFullScreen() {
            $('#fullScreenModal').modal('hide');
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/drop.js"></script>
</body>

</html>