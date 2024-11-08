<?php
/**
 * Contains code for the admin order page class.
 *
 * @package     Boxtal\BoxtalConnectWoocommerce\Tracking
 */

namespace Boxtal\BoxtalConnectWoocommerce\Tracking;

use Boxtal\BoxtalConnectWoocommerce\Util\Order_Util;

/**
 * Admin_Order_Page class.
 *
 * Adds tracking info to order page.
 *
 * @class       Admin_Order_Page
 * @package     Boxtal\BoxtalConnectWoocommerce\Tracking
 * @category    Class
 * @author      API Boxtal
 */
class Admin_Order_Page {

	/**
	 * Construct function.
	 *
	 * @param array $plugin plugin array.
	 * @void
	 */
	public function __construct( $plugin ) {
		$this->plugin_url     = $plugin['url'];
		$this->plugin_version = $plugin['version'];
		$this->tracking       = null;
	}

	/**
	 * Run class.
	 *
	 * @void
	 */
	public function run() {
		$controller = new Controller(
			array(
				'url'     => $this->plugin_url,
				'version' => $this->plugin_version,
			)
		);
		add_action( 'admin_enqueue_scripts', array( $controller, 'tracking_styles' ) );
		add_filter( 'add_meta_boxes_shop_order', array( $this, 'add_tracking_to_admin_order_page' ), 10, 2 );
		add_filter( 'woocommerce_admin_order_preview_get_order_details', array( $this, 'order_view_modal_details' ) );
		add_filter( 'woocommerce_admin_order_preview_end', array( $this, 'order_view_modal' ) );
	}

	/**
	 * Add tracking info to front order page.
	 *
	 * @void
	 */
	public function add_tracking_to_admin_order_page() {
		$controller     = new Controller(
			array(
				'url'     => $this->plugin_url,
				'version' => $this->plugin_version,
			)
		);
		$this->tracking = $controller->get_order_tracking( Order_Util::get_id( Order_Util::admin_get_order() ) );
		if ( null === $this->tracking || ! property_exists( $this->tracking, 'shipmentsTracking' ) || empty( $this->tracking->shipmentsTracking ) ) {
			return;
		}
		if ( function_exists( 'wc_get_order_types' ) ) {
			foreach ( wc_get_order_types( 'order-meta-boxes' ) as $type ) {
				add_meta_box( 'boxtal-order-tracking', __( 'Boxtal - Shipment tracking', 'boxtal-connect' ), array( $this, 'order_edit_page' ), $type, 'normal', 'high' );
			}
		} else {
			add_meta_box( 'boxtal-order-tracking', __( 'Boxtal - Shipment tracking', 'boxtal-connect' ), array( $this, 'order_edit_page' ), 'shop_order', 'normal', 'high' );
		}
	}

	/**
	 * Order edit page output.
	 *
	 * @void
	 */
	public function order_edit_page() {
		$tracking = $this->tracking;
		include realpath( plugin_dir_path( __DIR__ ) ) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'html-admin-order-edit-page-tracking.php';
	}

	/**
	 * Order view modal details.
	 *
	 * @param array $order_details order details sent to template.
	 *
	 * @return array
	 */
	public function order_view_modal_details( $order_details ) {
		$controller = new Controller(
			array(
				'url'     => $this->plugin_url,
				'version' => $this->plugin_version,
			)
		);

		if ( ! isset( $order_details['order_number'] ) ) {
			return $order_details;
		}
		$tracking = $controller->get_order_tracking( $order_details['order_number'] );

		//phpcs:ignore
		if ( null === $tracking || ! property_exists( $tracking, 'shipmentsTracking' ) || empty( $tracking->shipmentsTracking ) ) {
			return $order_details;
		}
		ob_start();
		include realpath( plugin_dir_path( __DIR__ ) ) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'html-admin-order-view-modal-tracking.php';
		$html                           = ob_get_clean();
		$order_details['tracking_html'] = $html;
		return $order_details;
	}

	/**
	 * Order view modal.
	 *
	 * @void
	 */
	public function order_view_modal() {
		include realpath( plugin_dir_path( __DIR__ ) ) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'html-admin-order-view-modal-print-tracking.php';
	}
}
