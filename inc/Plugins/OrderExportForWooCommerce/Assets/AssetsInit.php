<?php

namespace WPEssential\Plugins\OrderExportForWooCommerce\Assets;

class AssetsInit
{
	public static function constructor ()
	{
		//self::run();
	}

	protected static function run ()
	{
		RegisterAssets::constructor();
		Enqueue::constructor();
	}
}
