<?php

if ( ! \defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
function wpeoefw_install ()
{
	$dir_check = wp_get_upload_dir()[ 'basedir' ] . '/wpessential-order-export-for-woocommerce';
	if ( ! is_dir( $dir_check ) ) {
		wp_mkdir_p( $dir_check );
	}
}
