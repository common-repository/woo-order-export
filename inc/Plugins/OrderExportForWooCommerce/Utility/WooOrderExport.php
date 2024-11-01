<?phpnamespace WPEssential\Plugins\OrderExportForWooCommerce\Utility;if ( ! defined( 'ABSPATH' ) ) {	exit; // Exit if accessed directly.}class WooOrderExport{	public static function constructor ()	{		add_action( 'admin_menu', [ __CLASS__, 'woe_add_page_link' ] );	}	public static function woe_add_page_link ()	{		$page = add_submenu_page(			'woocommerce',			esc_html__( 'Orders Export', 'wpessential-order-export-for-woocommerce' ),			esc_html__( 'Orders Export', 'wpessential-order-export-for-woocommerce' ),			'edit_posts',			'order_exports',			[ __CLASS__, 'woe_add_form' ]		);		add_action( "admin_print_scripts-$page", [ __CLASS__, 'woe_enqueue_scripts' ] );	}	public static function woe_add_form ()	{		?>		<div class="container">			<form method="post" class="order_export_form">				<h1><?php echo esc_html( 'Orders Export' ); ?></h1>				<div class="row">					<div class="col-25">						<label for="fdate"><?php esc_html_e( 'Start Date', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<input type="text" id="form_date" name="from_date" required placeholder="MM/DD/YY">					</div>				</div>				<div class="row">					<div class="col-25">						<label for="tdate"><?php esc_html_e( 'End Date', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<input type="text" id="to_date" name="to_date" required placeholder="MM/DD/YY">					</div>				</div>				<div class="row">					<div class="col-25">						<label for="order_status"><?php esc_html_e( 'Order Status', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<select name="order_status">							<option value="wc-on-hold" selected="selected"><?php esc_html_e( 'On hold', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-failed"><?php esc_html_e( 'Failed', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-refunded"><?php esc_html_e( 'Refunded', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-completed"><?php esc_html_e( 'Completed', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-cancelled"><?php esc_html_e( 'Cancelled', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-pending"><?php esc_html_e( 'Pending payment', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="wc-processing"><?php esc_html_e( 'Processing', 'wpessential-order-export-for-woocommerce' ) ?></option>						</select>					</div>				</div>				<div class="row">					<div class="col-25">						<label for="post_order"><?php esc_html_e( 'Post Order', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<select name="order">							<option value="DESC" selected="selected"><?php esc_html_e( 'Desending', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="ASC"><?php esc_html_e( 'Asending', 'wpessential-order-export-for-woocommerce' ) ?></option>						</select>					</div>				</div>				<div class="row">					<div class="col-25">						<label for="post_order_by"><?php esc_html_e( 'Post Order By', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<select name="orderby">							<option value="none" selected="selected"><?php esc_html_e( 'None', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="ID"><?php esc_html_e( 'IDs', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="name"><?php esc_html_e( 'Name', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="type"><?php esc_html_e( 'Type', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="rand"><?php esc_html_e( 'Random', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="date"><?php esc_html_e( 'Date', 'wpessential-order-export-for-woocommerce' ) ?></option>							<option value="modified"><?php esc_html_e( 'Modified', 'wpessential-order-export-for-woocommerce' ) ?></option>						</select>					</div>				</div>				<div class="row">					<div class="col-25">						<label for="custom_address"><?php esc_html_e( 'Customer Email', 'wpessential-order-export-for-woocommerce' ) ?>:</label>					</div>					<div class="col-75">						<input type="email" id="custom_address" name="custom_address" placeholder="admin@example.com">					</div>				</div>				<div class="row">					<?php wp_nonce_field( 'woe_order_file_download', 'export_orders_ref' ); ?>					<input type="submit" value="<?php esc_attr_e( 'Export Orders', 'wpessential-order-export-for-woocommerce' ); ?>">				</div>			</form>		</div>		<?php	}	public static function woe_enqueue_scripts ()	{		wp_enqueue_style( 'jquery-ui-datepicker-css', WPEOEFW_URL . 'assets/css/jquery-ui.min.css', '', WPEOEFW_VERSION, 'all' );		wp_enqueue_style( 'wpessential-order-export-for-woocommerce', WPEOEFW_URL . 'assets/css/woo-order-export.css', '', WPEOEFW_VERSION, 'all' );		$script = 'jQuery(document).ready(function($){			$("#form_date, #to_date").datepicker();			$(".order_export_form").submit(function(e){				e.preventDefault();				var form_data = "action=woe_order_file_download&" + $(this).serialize();				$.ajax({url:"' . admin_url( 'admin-ajax.php' ) . '",type: "POST",data: form_data,success: function(res){if(res != 0){window.open(res);}else{alert("' . esc_js( 'Data Not Exist.' ) . '");}}});			});		})';		wp_enqueue_script( 'jquery-ui-datepicker' );		wp_add_inline_script( 'jquery-ui-datepicker', $script );	}}