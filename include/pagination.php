<?php
// Include your config.php file to establish the database connection
include 'include/config.php';

// Set the number of products per page
$products_per_page = 2;

// Get the current page number from the URL (default to 1 if not set)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL LIMIT clause
$offset = ($page - 1) * $products_per_page;

// Fetch the total number of products (replace 'products_table' with your actual table)
$total_products_query = "SELECT COUNT(*) AS total FROM ittadi";
$total_products_result = mysqli_query($conn, $total_products_query);
$total_products_row = mysqli_fetch_assoc($total_products_result);
$total_products = $total_products_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_products / $products_per_page);

// Fetch the products for the current page
$products_query = "SELECT * FROM products_table LIMIT $offset, $products_per_page";
$products_result = mysqli_query($conn, $products_query);

// Loop through the products and display them
while ($product = mysqli_fetch_assoc($products_result)) {
    $price = $product['price'];
    $o_price = isset($product['offer_price']) ? $product['offer_price'] : null;

    // Check if the offer price is set and less than the original price
    if ($o_price && $o_price <= $price) {
        // Calculate the discount percentage
        $discount_percentage = (($price - $o_price) / $price) * 100;
        ?>
        <div class="price-container">
            <span class="amount">৳<?php echo number_format($o_price, 2); ?></span>
            <span class="original-price">৳<?php echo number_format($price, 2); ?></span>
            <span class="discount-percentage">
                <?php echo number_format(-$discount_percentage, 2); ?>%
            </span>
        </div>
        <?php
    } else {
        // Only show the original price without strikethrough if there's no offer price
        ?>
        <div class="price-container">
            <span class="no-offer">৳<?php echo number_format($price, 2); ?></span>
        </div>
        <?php
    }
}

// Pagination links
echo '<div class="pagination">';
if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . '">&laquo; Previous</a>';
}
for ($i = 1; $i <= $total_pages; $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
}
if ($page < $total_pages) {
    echo '<a href="?page=' . ($page + 1) . '">Next &raquo;</a>';
}

?>
