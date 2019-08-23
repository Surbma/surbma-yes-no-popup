<?php

/*
Plugin Name: CPS | Age Verification
Plugin URI: https://surbma.com/wordpress-plugins/
Description: Shows a popup with age verification options.

Version: 5.2

Author: CherryPickStudios
Author URI: https://www.cherrypickstudios.com/

License: GPLv2

Text Domain: surbma-yes-no-popup
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Good try! :)' );

define( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_FILE', __FILE__ );

// Localization
function surbma_yes_no_popup_init() {
	load_plugin_textdomain( 'surbma-yes-no-popup', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'surbma_yes_no_popup_init' );

// Freemius SDK wrap to prevent conflicts with premium version.
if ( function_exists( 'surbma_ynp_fs' ) ) {

	// Check if premium version is used.
	if( surbma_ynp_fs()->is__premium_only() ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION', 'premium' );
	}

	// Set license.
	if( surbma_ynp_fs()->can_use_premium_code() ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'valid' );
	} elseif( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION' ) && SURBMA_YES_NO_POPUP_PLUGIN_VERSION == 'premium' ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'expired' );
	}

}

// Set plugin veryion to free if premium version is not active.
if( !defined( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION' ) ) {
	define( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION', 'free' );
}

// Set plugin license to free if premium version is not active.
if( !defined( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE' ) ) {
	define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'free' );
}

// CPS SDK
if ( !function_exists( 'cps' ) ) {
	function cps() {
		// Include CPS SDK.
		require_once dirname( __FILE__ ) . '/cps/start.php';
	}

	// Init CPS.
	cps();
}

// Include files
if ( is_admin() ) {
	include_once( SURBMA_YES_NO_POPUP_PLUGIN_DIR . '/lib/admin.php' );
}

function surbma_yes_no_popup_enqueue_scripts() {
	$options = get_option( 'surbma_yes_no_popup_fields' );
	$popupstylesValue = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
	wp_enqueue_script( 'surbma-yes-no-popup-scripts', plugins_url( '', __FILE__ ) . '/assets/js/scripts-min.js', array( 'jquery' ), '2.27.5', true );
	wp_enqueue_style( 'surbma-yes-no-popup-styles', plugins_url( '', __FILE__ ) . '/assets/css/styles-' . $popupstylesValue . '.css', false, '2.27.5' );
}
add_action( 'wp_enqueue_scripts', 'surbma_yes_no_popup_enqueue_scripts', 999 );

function surbma_yes_no_popup_show() {
	$options = get_option( 'surbma_yes_no_popup_fields' );

	$popupshoweverywhereValue = isset( $options['popupshoweverywhere'] ) ? $options['popupshoweverywhere'] : 0;
	$popupexcepthereValue = isset( $options['popupexcepthere'] ) ? $options['popupexcepthere'] : '';

	if( $popupshoweverywhereValue == 1 && $popupexcepthereValue == '' ) {
		add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
	}
	elseif( $popupshoweverywhereValue == 1 && $popupexcepthereValue != '' && !is_page( $popupexcepthereValue ) ) {
		add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
	}
	else {
		if( isset( $options['popupshowfrontpage'] ) && $options['popupshowfrontpage'] == 1 && is_front_page() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( isset( $options['popupshowblog'] ) && $options['popupshowblog'] == 1 && is_home() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		if( isset( $options['popupshowarchive'] ) && $options['popupshowarchive'] == 1 && is_archive() ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
			$popupshowcpt = 'popupshowcpt-' . $post_type->name;
			if( isset( $options[$popupshowcpt] ) && $options[$popupshowcpt] != '' && is_singular( $post_type->name ) ) {
				add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
			}
		}
		$includeposts = isset( $options['popupshowposts'] ) ? explode( ',', $options['popupshowposts'] ) : '';
		if( $includeposts != '' && is_single( $includeposts ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includepages = isset( $options['popupshowpages'] ) ? explode( ',', $options['popupshowpages'] ) : '';
		if( $includepages != '' && is_page( $includepages ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
		$includecategories = isset( $options['popupshowcategories'] ) ? explode( ',', $options['popupshowcategories'] ) : '';
		if( $includecategories != '' && $options['popupshowarchive'] != 1 && ( is_category( $includecategories ) || in_category( $includecategories ) ) ) {
			add_action( 'wp_footer', 'surbma_yes_no_popup_block', 999 );
		}
	}
}
add_action( 'wp_footer', 'surbma_yes_no_popup_show' );

function surbma_yes_no_popup_block() {
	$options = get_option( 'surbma_yes_no_popup_fields' );

	$popupimageValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupimage'] ) ? esc_attr__( $options['popupimage'] ) : '';
	$popuptitleValue = isset( $options['popuptitle'] ) ? stripslashes( $options['popuptitle'] ) : '';
	$popuptextValue = isset( $options['popuptext'] ) ? stripslashes( $options['popuptext'] ) : '';
	$popupbutton1textValue = isset( $options['popupbutton1text'] ) ? stripslashes( $options['popupbutton1text'] ) : '';
	$popupbutton2textValue = isset( $options['popupbutton2text'] ) ? stripslashes( $options['popupbutton2text'] ) : '';
	$popupbuttonurlValue = isset( $options['popupbuttonurl'] ) ? esc_attr__( $options['popupbuttonurl'] ) : '/';
	$popupbuttonoptionsValue = isset( $options['popupbuttonoptions'] ) ? $options['popupbuttonoptions'] : 'button-1-redirect';

	$popupimagealignmentValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupimagealignment'] ) ? $options['popupimagealignment'] : 'left';
	$popupbackgroundimageValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupbackgroundimage'] ) ? $options['popupbackgroundimage'] : '';
	$popupstylesValue = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
	$popupthemesValue = isset( $options['popupthemes'] ) && $options['popupthemes'] != '' ? $options['popupthemes'] : 'normal';
	$popupdarkmodeValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupdarkmode'] ) && $options['popupdarkmode'] == 1 ? ' surbma-yes-no-popup-dark' : '';
	$popupcentertextValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupcentertext'] ) && $options['popupcentertext'] == 1 ? ' surbma-yes-no-popup-text-center' : '';
	$popupverticalcenterValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupverticalcenter'] ) && $options['popupverticalcenter'] == 1 ? 'true' : 'false';
	$popuplargeValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popuplarge'] ) && $options['popuplarge'] == 1 ? ' uk-modal-dialog-large' : '';
	$popupbutton1styleValue = isset( $options['popupbutton1style'] ) ? $options['popupbutton1style'] : 'default';
	$popupbutton2styleValue = isset( $options['popupbutton2style'] ) ? $options['popupbutton2style'] : 'primary';
	$popupbuttonsizeValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupbuttonsize'] ) ? $options['popupbuttonsize'] : 'large';
	$popupbuttonalignmentValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupbuttonalignment'] ) ? $options['popupbuttonalignment'] : 'left';

	$popuphideloggedinValue = isset( $options['popuphideloggedin'] ) && $options['popuphideloggedin'] == 1 && is_user_logged_in() ? 1 : 0;
	$popupshownotloggedinValue = isset( $options['popupshownotloggedin'] ) && $options['popupshownotloggedin'] == 1 && !is_user_logged_in() ? 1 : 0;
	$popuphidebutton2Value = isset( $options['popuphidebutton2'] ) && $options['popuphidebutton2'] == 1 ? 1 : 0;
	$popupdebugValue = isset( $options['popupdebug'] ) && $options['popupdebug'] == 1 ? 1 : 0;

	$popupclosebuttonValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupclosebutton'] ) ? $options['popupclosebutton'] : 0;
	$popupclosekeyboardValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && $popupdebugValue == 1 || ( isset( $options['popupclosekeyboard'] ) && $options['popupclosekeyboard'] == 1 ) ? 'true' : 'false';
	$popupclosebgcloseValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupclosebgclose'] ) && $options['popupclosebgclose'] == 1 ? 'true' : 'false';
	$popupdelayValue = SURBMA_YES_NO_POPUP_PLUGIN_LICENSE == 'valid' && isset( $options['popupdelay'] ) ? $options['popupdelay'] : 0;
	$popupdelayValue = 1000 * (int)$popupdelayValue;
	$popupcookiedaysValue = isset( $options['popupcookiedays'] ) && $options['popupcookiedays'] != '' ? $options['popupcookiedays'] : 1;
	?>
<input type="hidden" id="popuphideloggedin" value="<?php echo $popuphideloggedinValue; ?>" />
<input type="hidden" id="popupshownotloggedin" value="<?php echo $popupshownotloggedinValue; ?>" />
<input type="hidden" id="popupdebug" value="<?php echo $popupdebugValue; ?>" />
<script type="text/javascript">
	function surbma_ynp_openModal() {
		UIkit.modal(('#surbma-yes-no-popup'), {center: <?php echo $popupverticalcenterValue; ?>,keyboard: <?php echo $popupclosekeyboardValue; ?>,bgclose: <?php echo $popupclosebgcloseValue; ?>}).show();
	}
	jQuery(document).ready(function($) {
		var show_modal = 0;
		if( $('#popupdebug').val() == '1' || $('#popupshownotloggedin').val() == '1' ) {
			show_modal = 1;
		} else {
			if( surbma_ynp_readCookie('surbma-yes-no-popup') != 'yes' && $('#popuphideloggedin').val() != '1' ) {
				show_modal = 1;
			}
		}
		if( show_modal == 1 ) {
			setTimeout(function() {
				surbma_ynp_openModal();
			}, <?php echo $popupdelayValue; ?>);
		}
		// console.log('show_modal'+show_modal);
	});
</script>
<div id="surbma-yes-no-popup" class="uk-modal surbma-yes-no-popup-<?php echo $popupthemesValue; ?><?php echo $popupdarkmodeValue; ?><?php echo $popupcentertextValue; ?> surbma-yes-no-popup-<?php echo $popupstylesValue; ?>" style="background-image: url(<?php echo esc_attr_e( $popupbackgroundimageValue ); ?>);background-size: cover;background-repeat: no-repeat;">
    <div class="uk-modal-dialog<?php echo $popuplargeValue; ?>">
		<?php if( $popupclosebuttonValue == 1 ) { ?>
			<a class="uk-modal-close uk-close"></a>
		<?php } ?>
		<?php if( $popupimageValue != '' || $popuptitleValue != '' ) { ?>
			<div class="uk-modal-header">
				<?php if( $popupimageValue != '' ) { ?>
					<p class="surbma-yes-no-popup-image-<?php echo $popupimagealignmentValue; ?>"><img src="<?php echo $popupimageValue; ?>" class="" alt="<?php echo esc_attr__( $popuptitleValue ); ?>"></p>
				<?php } ?>
				<?php if( $popuptitleValue != '' ) { ?>
					<h2><a href="#"></a><?php echo $popuptitleValue; ?></h2>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if( $popuptextValue != '' ) { ?>
			<div class="uk-modal-content"><?php echo $popuptextValue; ?></div>
		<?php } ?>
		<div class="uk-modal-footer surbma-yes-no-popup-button-<?php echo $popupbuttonalignmentValue; ?>">
			<button id="button1" type="button" class="uk-button uk-button-<?php echo $popupbuttonsizeValue; ?> uk-button-<?php echo esc_attr_e( $popupbutton1styleValue ); ?><?php if( $popupbuttonoptionsValue != 'button-1-redirect' ) echo ' uk-modal-close'; ?>"><?php echo $popupbutton1textValue; ?></button>
			<?php if( $popuphidebutton2Value != 1 ) { ?>
				<button id="button2" type="button" class="uk-button uk-button-<?php echo $popupbuttonsizeValue; ?> uk-button-<?php echo esc_attr_e( $popupbutton2styleValue ); ?><?php if( $popupbuttonoptionsValue == 'button-1-redirect' ) echo ' uk-modal-close'; ?>"><?php echo $popupbutton2textValue; ?></button>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function surbma_ynp_setCookie() {
	    var d = new Date();
	    d.setTime(d.getTime() + (<?php echo esc_attr_e( $popupcookiedaysValue ); ?>*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = "surbma-yes-no-popup=yes;" + expires + ";path=/";
	}
	function surbma_ynp_readCookie(cookieName) {
		var re = new RegExp('[; ]'+cookieName+'=([^\\s;]*)');
		var sMatch = (' '+document.cookie).match(re);
		if (cookieName && sMatch) return unescape(sMatch[1]);
		return '';
	}
	<?php if( $popupbuttonoptionsValue != 'button-1-redirect' ) { ?>
    	document.getElementById("button1").onclick = function () {
			surbma_ynp_setCookie();
    	};
    	document.getElementById("button2").onclick = function () {
        	location.href = "<?php echo $popupbuttonurlValue; ?>";
    	};
	<?php } else { ?>
    	document.getElementById("button1").onclick = function () {
        	location.href = "<?php echo $popupbuttonurlValue; ?>";
    	};
    	document.getElementById("button2").onclick = function () {
			surbma_ynp_setCookie();
    	};
	<?php } ?>
</script>
<?php
}
