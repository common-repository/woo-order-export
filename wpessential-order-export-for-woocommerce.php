<?php
/**
 * Plugin Name: WPEssential Order Export for WooCommerce
 * Plugin URI: https://wpessential.org/
 * Description: WPEssential Order Export for WooCommerce used to export the WooCommerce orders with all details. It has the option to export the order from a selectable date range and order status base.
 * Version: 4.0
 * Author: WPEssential
 * Author URI: https://wpessential.org/
 * Text Domain: wpessential-order-export-for-woocommerce
 * Requires at least: 4.5
 * Tested up to: 6.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages/
 * WC requires at least: 3.0.0
 * WC tested up to: 6.0
 */

use WPEssential\Plugins\OrderExportForWooCommerceInit;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once plugin_dir_path( __FILE__ ) . 'constants.php';

/**
 * The notification html
 *
 * @return string Return the HTML of notification.
 * @since 1.0.0
 */
if ( ! function_exists( 'woo_order_export_swatches_wc_notice' ) ) {
	function woo_order_export_swatches_wc_notice ()
	{
		?>
		<div class="error">
			<p><?php esc_html_e( 'Woo Order Export is enabled but not effective. It requires WooCommerce in order to work.', 'wpessential-order-export-for-woocommerce' ); ?></p>
		</div>
		<?php
	}
}

/**
 * Hook the notification
 *
 * @return void.
 * @since 1.0.0
 */
if ( ! function_exists( 'woo_order_export_swatches_constructor' ) ) {
	function woo_order_export_swatches_constructor ()
	{
		if ( ! function_exists( 'WC' ) ) {
			add_action( 'admin_notices', 'woo_order_export_swatches_wc_notice' );
		}
		else {
			OrderExportForWooCommerceInit::constructor();
		}
	}
}

require_once WPEOEFW_DIR . 'install.php';
require_once WPEOEFW_DIR . 'uninstall.php';
require_once WPEOEFW_DIR . 'vendor/autoload.php';
add_action( 'plugins_loaded', 'woo_order_export_swatches_constructor', 20 );

register_activation_hook( __FILE__, 'wpeoefw_install' );
register_deactivation_hook( __FILE__, 'wpeoefw_unsintall' );
