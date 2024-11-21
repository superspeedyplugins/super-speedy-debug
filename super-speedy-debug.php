<?php
/**
 * Plugin Name: Super Speedy Debug
 * Plugin URI:  https://github.com/superspeedyplugins/super-speedy-debug
 * Description: A debugging tool to simulate adding products to the cart and updating product names so you can view performance with Query Monitor.
 * Version:     1.0
 * Author:      Dave Hilditch
 * Author URI:  https://www.superspeedyplugins.com
 * License:     GPL-2.0+
 * Text Domain: super-speedy-debug
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure WooCommerce is active before initializing the plugin.
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    class SuperSpeedyDebug {

        /**
         * Constructor: Hooks plugin functionality into WordPress actions.
         */
        public function __construct() {
            // Hook add-to-cart simulation to the frontend.
            add_action( 'template_redirect', [ $this, 'simulate_add_to_cart' ] );

            // Hook product name update simulation to the admin area.
            add_action( 'admin_init', [ $this, 'simulate_product_update' ] );
        }

        /**
         * Simulate adding a product to the cart during page load.
         */
        public function simulate_add_to_cart() {
            // Specify the product ID to add.
            if (!array_key_exists('test-add-to-cart', $_GET)) {
                return;
            }
            $product_id = $_GET['test-add-to-cart'];
    
            // Ensure WooCommerce cart is initialized.
            if ( WC()->cart && ! WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product_id ) ) ) {
                // Add the product to the cart.
                WC()->cart->add_to_cart( $product_id );

                // Optionally, add a notice for debugging.
                wc_add_notice( __( 'Product added to cart for debugging purposes.', 'super-speedy-debug' ), 'notice' );
            }
        }

        /**
         * Simulate updating a product name by appending a space.
         */
        public function simulate_product_update() {
            // Check for specific query parameters to trigger the update.
            if ( isset( $_GET['test-update-product'] ) ) {
                $product_id = intval( $_GET['test-update-product'] ); // Sanitize product ID.

                // Get the product.
                $product = wc_get_product( $product_id );
                if ( ! $product ) {
                    wp_die( 'Invalid product ID.' ); // Stop if the product doesn't exist.
                }

                // Modify the product name.
                $current_name = $product->get_name();
                $new_name = $current_name . ' - super-speedy-test'; // Append some text

                // Update the product name.
                $product->set_name( $new_name );
                $product->save();

                // Output a success message.
                echo 'Product updated successfully: ' . esc_html( $new_name );

            }
        }
    }

    // Initialize the plugin.
    new SuperSpeedyDebug();
}
