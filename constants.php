<?php

if ( ! \defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define the plugin directory url in http:// or https:// base
 *
 * @since 3.0
 */
if ( ! defined( 'WPEOEFW_URL' ) ) {
	define( 'WPEOEFW_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Define the plugin directory path
 *
 * @since 3.0
 */
if ( ! defined( 'WPEOEFW_DIR' ) ) {
	define( 'WPEOEFW_DIR', plugin_dir_path( __FILE__ ) );
}

/**
 * Define the plugin version
 *
 * @since 3.0
 */
if ( ! defined( 'WPEOEFW_VERSION' ) ) {
	if ( ! function_exists( 'get_plugin_data' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	$data = get_plugin_data( WPEOEFW_DIR . 'wpessential-order-export-for-woocommerce.php' );
	define( 'WPEOEFW_VERSION', $data[ 'Version' ] );
}
