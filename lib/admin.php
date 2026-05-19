<?php

/* Admin options menu */
add_action( 'admin_menu', function() {
	global $surbma_yes_no_popup_settings_page;
	$surbma_yes_no_popup_settings_page = add_submenu_page(
		'cps-plugins-menu',
		__( 'CPS | Age Verification', 'surbma-yes-no-popup' ),
		__( 'Age Verification', 'surbma-yes-no-popup' ),
		'manage_options',
		'surbma-yes-no-popup-menu',
		'surbma_yes_no_popup_settings_page'
	);
} );

// Custom styles and scripts for admin pages
function surbma_yes_no_popup_admin_enqueue_scripts( $hook ) {
	global $surbma_yes_no_popup_settings_page;
	if ( $hook == $surbma_yes_no_popup_settings_page ) {
		add_action( 'admin_enqueue_scripts', 'cps_admin_scripts', 9999 );
		// UPLOAD ENGINE
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'surbma_yes_no_popup_admin_enqueue_scripts' );

function surbma_yes_no_popup_admin_sidebar() {
	global $surbma_ynp_fs;
	$options = get_option( 'cps_framework_fields' );
?><div uk-sticky="offset: 42; bottom: #bottom">
	<div class="uk-card uk-card-small uk-card-default uk-card-hover">
		<div class="uk-card-header uk-background-muted">
			<h3 class="uk-card-title"><?php _e( 'Informations', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #informations"></a></h3>
		</div>
		<div id="informations" class="uk-card-body">
			<?php if( SURBMA_YES_NO_POPUP_PLUGIN_VERSION == 'free' ) { ?>
			<p><a id="purchase" class="uk-button uk-button-large uk-button-danger uk-width-1-1" href="#" title="<?php _e( 'Activate all the features of the CPS | Age Verification plugin!', 'surbma-yes-no-popup' ); ?>"><?php _e( 'Buy Premium Now!', 'surbma-yes-no-popup' ); ?></a></p>
			<p><?php _e( 'With the Premium version you unlock all the fantastic features of this plugin. For a single site, it is <strong>$19.99</strong> for a year. With this small price, you support our work to make better products for you. Thank you!', 'surbma-yes-no-popup' ); ?></p>
			<div class="uk-alert-primary" style="display: none;" uk-alert>
				<?php _e( '<p>Use this special <strong>COUPON</strong> coupon to get 50% OFF your first purchase, which is available till <strong>Dec 31, 2099</strong></p>', 'surbma-yes-no-popup' ); ?>
			</div>
			<?php } ?>
			<?php if( SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'expired' ) { ?>
			<div class="uk-alert-danger" uk-alert>
				<?php _e( '<p>You have the Premium version, but your License is expired. Please renew your license to unlock all Premium features of this plugin!</p>', 'surbma-yes-no-popup' ); ?>
			</div>
			<p><a class="uk-button uk-button-large uk-button-danger uk-width-1-1" href="<?php echo $surbma_ynp_fs->get_upgrade_url(); ?>" title="<?php _e( 'Activate all the features of the CPS | Age Verification plugin!', 'surbma-yes-no-popup' ); ?>"><?php _e( 'Renew Your License', 'surbma-yes-no-popup' ); ?></a></p>
			<?php } ?>

			<h4 class="uk-heading-divider"><?php _e( 'Plugin links', 'surbma-yes-no-popup' ); ?></h4>
			<ul class="uk-list">
				<li><a href="https://wordpress.org/support/plugin/surbma-yes-no-popup/" target="_blank"><?php _e( 'Official support forum', 'surbma-yes-no-popup' ); ?></a></li>
				<li><a href="https://hu.wordpress.org/plugins/surbma-yes-no-popup/#reviews" target="_blank"><?php _e( 'Read our reviews', 'surbma-yes-no-popup' ); ?></a></li>
			</ul>
			<hr>
			<p>
				<strong><?php _e( 'Do you like this plugin? Please give a 5 star review', 'surbma-yes-no-popup' ); ?>:</strong>
				 <a href="https://wordpress.org/support/plugin/surbma-yes-no-popup/reviews/#new-post" target="_blank"><?php _e( 'write a new review', 'surbma-yes-no-popup' ); ?></a>
			</p>
			<h4 class="uk-heading-divider"><?php _e( 'Features coming soon', 'surbma-yes-no-popup' ); ?></h4>
			<ul class="uk-list">
				<li><span uk-icon="icon: check; ratio: 0.8"></span> <?php _e( 'Transparent layer for the background image', 'surbma-yes-no-popup' ); ?></li>
				<li><span uk-icon="icon: check; ratio: 0.8"></span> <?php _e( 'Birthday validation', 'surbma-yes-no-popup' ); ?></li>
			</ul>
		</div>
		<div class="uk-card-footer uk-background-muted">
			<p class="uk-text-right"><?php _e( 'License: GPLv2', 'surbma-yes-no-popup' ); ?></p>
		</div>
	</div>
</div>
<script src="https://checkout.freemius.com/checkout.min.js"></script>
<script>
	var handler = FS.Checkout.configure({
		plugin_id:  '4072',
		plan_id:    '6580',
		public_key: 'pk_6191951bc2f6ffce4f96a1204b24c'
	});
	jQuery('#purchase').on('click', function(e) {
		handler.open({
			name: 				'CPS | Age Verification',
			subtitle: 			'CPS | Age Verification Premium',
			licenses: 			1,
			purchaseCompleted: 	function(response){},
			success: 			function(response){}
		});
		e.preventDefault();
	});
</script>
<?php
}

/*
// Admin notice classes:
// notice-success
// notice-success notice-alt
// notice-info
// notice-warning
// notice-error
// Without a class, there is no colored left border.
*/

// Welcome notice
function surbma_yes_no_popup_admin_notice__welcome() {
	if ( ! PAnD::is_admin_notice_active( 'surbma_yes_no_popup-notice-welcome-forever' ) ) return;

	$linkStart = '<a href="' . admin_url() . 'admin.php?page=surbma-yes-no-popup-menu">';
	$linkEnd = '</a>';
	$home_url = get_option( 'home' );
	?>
	<div data-dismissible="surbma_yes_no_popup-notice-welcome-forever" class="notice notice-info is-dismissible">
		<div style="padding: 20px;">
			<img src="<?php echo SURBMA_YES_NO_POPUP_PLUGIN_URL; ?>/cps/assets/images/cps-logo.svg" alt="Cherry Pick Studios" style="width: 50px;">
			<p><strong><?php _e( 'Thank you for choosing CPS | Age Verification plugin!', 'surbma-yes-no-popup' ); ?></strong></p>
			<p><?php printf( esc_html__( 'The first step is to go to the %1$splugin\'s settings page%2$s, where you can set up your Age Verification popup!', 'surbma-yes-no-popup' ), $linkStart, $linkEnd ); ?></p>
			<p><?php _e( '<strong>IMPORTANT!</strong> This notification will never show up again after you close it.', 'surbma-yes-no-popup' ); ?></p>
			<p><?php _e( 'Please join our official Cherry Pick Studios support group to get support and give us feedback or recommend a new feature.', 'surbma-yes-no-popup' ); ?></p>
			<p><a href="https://www.facebook.com/groups/CherryPickStudios/" target="_blank" class="button button-primary"><span class="dashicons dashicons-facebook-alt" style="position: relative;top: 3px;left: -3px;"></span> CPS Facebook Group</a></p>
		</div>
	</div>
	<?php
}
add_action( 'admin_notices', 'surbma_yes_no_popup_admin_notice__welcome' );
