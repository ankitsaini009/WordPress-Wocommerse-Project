<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Example Helper Function: Format a Price
function format_price($price) {
    return '₹' . number_format($price, 2);
}

// Example Helper Function: Display Wishlist Count
function get_wishlist_count() {
    if (function_exists('yith_wcwl_count_products')) {
        return yith_wcwl_count_products();
    }
    return 0;
}
