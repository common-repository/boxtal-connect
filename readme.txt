=== Boxtal - Shipping solution ===
Contributors: Boxtal
Tags: shipping, delivery, parcel, parcel point, free, Mondial Relay, Colissimo, Chronopost, DHL, UPS, Relais Colis, Colis Privé
Requires at least: 4.6
Tested up to: 6.6.1
Requires PHP: 5.6.0
Stable tag: 1.3.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Negotiated rates for all types of shipping (home, relay, express, etc.). No subscription, no hidden fees.

== Description ==

Your orders are synchronized with your Boxtal account, where you can automate shipping rules to generate your shipping labels.

Ship with all types of carriers (Colissimo, Mondial Relay, Chronopost, Colis Privé, UPS, …), with or without insurance, options, ... You benefit from negotiated rates, without volume conditions, without subscription, without hidden costs.

Tracking is automatically synchronized with your orders and is available at any time in your customer’s account pages.

A single invoice for all your shipments and a single customer service to manage all delivery issues.

Add a parcel point map to your checkout.

This plugin rely on these third party services:
- Mapbox gl: https://github.com/mapbox/mapbox-gl-js
- tom-select: https://github.com/orchidjs/tom-select

Tools used to compile and minify this plugin's files: 
- css: gulp, gulp-less, gulp-clean-css
- js: gulp, gulp-babel, gulp-terser

== Installation ==

= Minimum requirements =
* WooCommerce version: 2.6.14 or greater
* WordPress version: 4.6 or greater
* Php version: 5.6.0 or greater

= Step by step guide =

* Have a look here: https://help.boxtal.com/fr/en/article/getting-started-bc-wc

== Screenshots ==

1. Synchronize your orders, save time
2. Ship with the best carriers
3. A single invoice, a single customer service
4. A parcel point map in your checkout

== Changelog ==

2024-09-05 - version 1.3.0
* Fixed woocommerce block and legacy detection on cart and checkout page
* Fixed typos

2024-08-27 - version 1.2.25
* Fixed an issue with cart and checkout translations
* Offers are now correctly refreshed when the cart change

2024-07-30 - version 1.2.24
* Fixed a shipping method display issue when no shipping classes were selected
* Fixed an error when updating a synchronized shipping order status

2024-07-29 - version 1.2.23
* Fixed many standard issues
* Shipping api calls now use wordpress http api
* Added logs