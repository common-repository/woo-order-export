<?php

namespace WPEssential\Plugins;

use WPEssential\Plugins\OrderExportForWooCommerce\Assets\AssetsInit;
use WPEssential\Plugins\OrderExportForWooCommerce\Requesting\RequestingInit;
use WPEssential\Plugins\OrderExportForWooCommerce\Utility\WooOrderExport;

final class OrderExportForWooCommerceInit
{
	public static function init ()
	{
		load_plugin_textdomain( 'wpessential-order-export-for-woocommerce', false, WPEOEFW_DIR . '/language' );
	}

	public static function constructor ()
	{
		self::load_files();
		self::start();
		add_action( 'wpessential_init', [ __CLASS__, 'init' ], 50 );
	}

	public static function load_files ()
	{
		require_once WPEOEFW_DIR . '/inc/Plugins/OrderExportForWooCommerce/Functions/general.php';
	}

	public static function start ()
	{
		AssetsInit::constructor();
		RequestingInit::constructor();
		WooOrderExport::constructor();
	}
}
