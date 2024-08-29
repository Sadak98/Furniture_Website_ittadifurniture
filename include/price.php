<!-- ////// -->
<?php
$price = $product['price'];
$o_price = isset($product['offer_price']) ? $product['offer_price'] : null;

// Check if the offer price is set and less than the original price
if ($o_price && $o_price <= $price) {
    // Calculate the discount percentage
    $discount_percentage = (($price - $o_price) / $price) * 100;
?>
    <div class="price-container">
        <span class="amount">৳<?php echo $o_price; ?></span> <br>
        <span class="original-price">৳<?php echo $price; ?></span>
        <span class="discount-percentage">
            <?php echo number_format(-$discount_percentage,2); ?>%
        </span>
    </div>
<?php
} else {
    // Only show the original price without strikethrough if there's no offer price
?>
    <div class="price-container">
        <span class="no-offer">৳<?php echo $price; ?></span>

    </div>
<?php
}
?>

<!-- /////// -->