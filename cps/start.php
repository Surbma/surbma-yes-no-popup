<?php

defined( 'ABSPATH' ) || exit;

// CPS SDK Version.
define( 'CPS_SDK_VERSION', '6.0' );

define( 'CPS_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CPS_URL', plugins_url( '', __FILE__ ) );

// https://github.com/collizo4sky/persist-admin-notices-dismissal
require CPS_DIR . '/vendors/pand/persist-admin-notices-dismissal.php';
add_action( 'admin_init', array( 'PAnD', 'init' ) );

// Include files.
if ( is_admin() ) {
	require_once CPS_DIR . '/lib/admin.php';
}

// Fix to load inline scripts after jQuery.
add_action( 'wp_enqueue_scripts', function() {
	wp_register_script( 'cps-jquery-fix', false, array( 'jquery' ), CPS_SDK_VERSION, true );
	wp_enqueue_script( 'cps-jquery-fix' );
} );

// Custom styles and scripts for admin pages
function cps_admin_scripts() {
	wp_enqueue_script( 'uikit-js', CPS_URL . '/vendors/uikit/js/uikit.min.js', array( 'jquery' ), '3.4.2' );
	wp_enqueue_script( 'uikit-icons', CPS_URL . '/vendors/uikit/js/uikit-icons.min.js', array( 'jquery' ), '3.4.2' );
	wp_enqueue_style( 'uikit-css', CPS_URL . '/vendors/uikit/css/uikit.min.css', false, '3.4.2' );
	wp_enqueue_style( 'cps-admin', CPS_URL . '/assets/css/cps-admin.css', false, CPS_SDK_VERSION );
}

function cps_admin_header( $plugin_file = '' ) {
	if ( '' !== $plugin_file ) {
		$plugin_data = get_plugin_data( $plugin_file );
		$plugin_name = $plugin_data['Name'];
		$headertitle = $plugin_name . ' <span>by CherryPick Studios</span>';
	} else {
		$headertitle = 'CherryPick Studios <span>WordPress Plugins, That Just Works.</span>';
	}
	$headertitle = apply_filters( 'cps_admin_header_title', $headertitle );
	$fburl = apply_filters( 'cps_admin_header_facebook_url', 'https://www.facebook.com/groups/CherryPickStudios/' );
	$fbtitle = apply_filters( 'cps_admin_header_facebook_title', 'Join the CherryPick Studios Facebook Group, where you can ask any question or ask for new features. Everybody is welcome!' );
	$fbbuttontext = apply_filters( 'cps_admin_header_facebook_button_text', 'Join CPS Support Group' );
	$email = apply_filters( 'cps_admin_header_email', 'hello@cherrypickstudios.com' );
	$emailtitle = apply_filters( 'cps_admin_header_email_title', 'CherryPick Studios Email Support' );
	$website = apply_filters( 'cps_admin_header_website', 'https://www.cherrypickstudios.com/' );
	$websitetitle = apply_filters( 'cps_admin_header_website_title', 'CherryPick Studios Website' );
	$text_domain = apply_filters( 'cps_admin_header_textdomain', 'cps-sdk' );
	?><nav class="uk-navbar-container uk-margin" id="cps-header" uk-navbar>
		<div class="uk-navbar-left">
			<div class="uk-navbar-item uk-logo">
				<img src="<?php echo esc_url( CPS_URL . '/assets/images/cps-logo.svg' ); ?>" alt="<?php esc_attr_e( 'Cherry Pick Studios', 'cps-sdk' ); ?>">
				<div><?php echo wp_kses_post( $headertitle ); ?></div>
			</div>
		</div>
		<div class="uk-navbar-right">
			<div class="uk-navbar-item">
				<a href="<?php echo esc_url( $fburl ); ?>" class="facebook-button uk-button uk-button-primary" title="<?php echo esc_attr( __( $fbtitle, $text_domain ) ); ?>" target="_blank" rel="noopener noreferrer"><span uk-icon="facebook"></span> <?php echo esc_html( __( $fbbuttontext, $text_domain ) ); ?></a>
			</div>
			<ul class="uk-navbar-nav">
				<li><a href="<?php echo esc_url( 'mailto:' . $email ); ?>" title="<?php echo esc_attr( __( $emailtitle, $text_domain ) ); ?>" target="_blank" rel="noopener noreferrer" uk-icon="mail"></a></li>
				<li><a href="<?php echo esc_url( $website ); ?>" title="<?php echo esc_attr( __( $websitetitle, $text_domain ) ); ?>" target="_blank" rel="noopener noreferrer" uk-icon="world"></a></li>
			</ul>
			<div class="uk-navbar-item"></div>
		</div>
	</nav>
	<div id="cps-admin-notification-placeholder" class="wrap"><h1></h1></div><?php
}

function cps_admin_footer( $plugin_file = '' ) {
	$plugin_version = '';
	$plugin_name = '';
	$plugin_plugin_uri = '';

	if ( '' !== $plugin_file ) {
		$plugin_data = get_plugin_data( $plugin_file );
		$plugin_version = $plugin_data['Version'];
		$plugin_name = $plugin_data['Name'];
		$plugin_plugin_uri = $plugin_data['PluginURI'];
	}
?>
<div class="uk-section uk-section-small">
	<div class="uk-text-center">
		<p>
			<?php if ( '' !== $plugin_file ) { ?>
			<strong><a class="uk-link-reset" href="<?php echo esc_url( $plugin_plugin_uri ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $plugin_name ); ?></a></strong> - v.<?php echo esc_html( $plugin_version ); ?><br>
			<?php } ?>
			Made with &hearts; by <img src="<?php echo esc_url( CPS_URL . '/assets/images/cps-logo.svg' ); ?>" alt="<?php esc_attr_e( 'Cherry Pick Studios', 'cps-sdk' ); ?>" width="20"> <a class="uk-link-reset" href="<?php echo esc_url( 'https://www.cherrypickstudios.com' ); ?>" target="_blank" rel="noopener noreferrer">CherryPick Studios</a>
		</p>
	</div>
</div>
<?php
}
