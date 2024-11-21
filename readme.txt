=== Super Speedy Debug ===
Contributors: dhilditch
Donate link: https://www.superspeedyplugins.com/
Tags: speed, performance, debug
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds debug commands for add-to-cart and update-product so you can see the speed using Query Monitor (i.e. instead of these being handled through ajax)

== Description ==

Adds debug commands for add-to-cart and update-product so you can see the speed using Query Monitor (i.e. instead of these being handled through ajax)

To test add to cart, from front end, add the following to your URL:

?test-add-to-cart={product_id}

To test update product, use URL: /wp-admin/?test-update-product={product_id}

Note: updating a product will add "- super-speedy-test" to the end of the product name so you will need to alter it back afterwards

https://imgur.com/nTvTjW1

== Changelog ==

= 1.0 (21st November 2024) =
* Initial creation 

