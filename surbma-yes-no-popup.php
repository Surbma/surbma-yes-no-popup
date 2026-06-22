<?php

/*
Plugin Name: CPS | Age Verification
Plugin URI: https://surbma.com/wordpress-plugins/
Description: Shows a popup with age verification options.

Version: 8.2.0

Author: CherryPickStudios
Author URI: https://www.cherrypickstudios.com/

License: GPLv2

Text Domain: surbma-yes-no-popup
Domain Path: /languages/
*/

defined( 'ABSPATH' ) || exit;

define( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'SURBMA_YES_NO_POPUP_PLUGIN_FILE', __FILE__ );

add_action( 'init', function() {
	load_plugin_textdomain( 'surbma-yes-no-popup', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}, 0 );

// Freemius SDK wrap to prevent conflicts with premium version.
if ( function_exists( 'surbma_ynp_fs' ) ) {

	// Check if premium version is used.
	if ( surbma_ynp_fs()->is__premium_only() ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION', 'premium' );
	}

	// Set license.
	if ( surbma_ynp_fs()->can_use_premium_code() ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'valid' );
	} elseif ( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION' ) && 'premium' === SURBMA_YES_NO_POPUP_PLUGIN_VERSION ) {
		define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'expired' );
	}

}

// Set plugin version to free if premium version is not active.
if ( ! defined( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION' ) ) {
	define( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION', 'free' );
}

// Set plugin license to free if premium version is not active.
if ( ! defined( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE' ) ) {
	define( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE', 'free' );
}

// CPS SDK
if ( !function_exists( 'cps' ) ) {
	function cps() {
		// Include CPS SDK.
		require_once SURBMA_YES_NO_POPUP_PLUGIN_DIR . 'cps/start.php';
	}

	// Init CPS.
	cps();
}

// admin_menu runs before admin_init in wp-admin; menu callbacks must register during plugin load.
if ( is_admin() ) {
	require_once SURBMA_YES_NO_POPUP_PLUGIN_DIR . 'pages/settings.php';
	require_once SURBMA_YES_NO_POPUP_PLUGIN_DIR . 'lib/admin.php';
}

add_action( 'admin_init', function() {
	if ( function_exists( 'surbma_yes_no_popup_register_settings' ) ) {
		surbma_yes_no_popup_register_settings();
	}
}, 0 );

add_action( 'wp_enqueue_scripts', function() {
	$options = get_option( 'surbma_yes_no_popup_fields' );
	$popupstyles_value = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
	wp_enqueue_script( 'surbma-yes-no-popup-scripts', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/assets/js/scripts-min.js', array( 'jquery' ), '2.27.5', true );
	wp_enqueue_style( 'surbma-yes-no-popup-styles', SURBMA_YES_NO_POPUP_PLUGIN_URL . '/assets/css/styles-' . sanitize_file_name( $popupstyles_value ) . '.css', false, '2.27.5' );
}, 999 );

add_action( 'wp_footer', function() {
	static $visibility_checked = false;

	if ( $visibility_checked ) {
		return;
	}

	$visibility_checked = true;

	$options = get_option( 'surbma_yes_no_popup_fields' );
	$show_popup = false;

	$popupshoweverywhere_value = isset( $options['popupshoweverywhere'] ) ? $options['popupshoweverywhere'] : 0;
	$popupexcepthere_value = isset( $options['popupexcepthere'] ) ? $options['popupexcepthere'] : '';

	if ( 1 == $popupshoweverywhere_value && '' === $popupexcepthere_value ) {
		$show_popup = true;
	} elseif ( 1 == $popupshoweverywhere_value && '' !== $popupexcepthere_value && ! is_page( $popupexcepthere_value ) ) {
		$show_popup = true;
	} else {
		if ( isset( $options['popupshowfrontpage'] ) && 1 == $options['popupshowfrontpage'] && is_front_page() ) {
			$show_popup = true;
		}

		if ( isset( $options['popupshowblog'] ) && 1 == $options['popupshowblog'] && is_home() ) {
			$show_popup = true;
		}

		if ( class_exists( 'WooCommerce' ) ) {
			if ( isset( $options['popupshowarchive'] ) && 1 == $options['popupshowarchive'] && is_archive() && ( ! is_shop() && ! is_product_category() && ! is_product_tag() ) ) {
				$show_popup = true;
			}
		} else {
			if ( isset( $options['popupshowarchive'] ) && 1 == $options['popupshowarchive'] && is_archive() ) {
				$show_popup = true;
			}
		}

		foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
			$popupshowcpt = 'popupshowcpt-' . $post_type->name;
			if ( isset( $options[ $popupshowcpt ] ) && '' !== $options[ $popupshowcpt ] && is_singular( $post_type->name ) ) {
				$show_popup = true;
			}
		}

		$includeposts = isset( $options['popupshowposts'] ) ? explode( ',', $options['popupshowposts'] ) : '';
		if ( '' !== $includeposts && is_single( $includeposts ) ) {
			$show_popup = true;
		}

		$includepages = isset( $options['popupshowpages'] ) ? explode( ',', $options['popupshowpages'] ) : '';
		if ( '' !== $includepages && is_page( $includepages ) ) {
			$show_popup = true;
		}

		$includecategories = isset( $options['popupshowcategories'] ) ? explode( ',', $options['popupshowcategories'] ) : '';
		if ( '' !== $includecategories && 1 != $options['popupshowarchive'] && ( is_category( $includecategories ) || in_category( $includecategories ) ) ) {
			$show_popup = true;
		}

		$includetags = isset( $options['popupshowtags'] ) ? explode( ',', $options['popupshowtags'] ) : '';
		if ( '' !== $includetags && 1 != $options['popupshowarchive'] && ( is_tag( $includetags ) || has_tag( $includetags ) ) ) {
			$show_popup = true;
		}

		if ( 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && class_exists( 'WooCommerce' ) ) {
			if ( isset( $options['popupshowwcshop'] ) && 1 == $options['popupshowwcshop'] && is_shop() ) {
				$show_popup = true;
			}

			if ( isset( $options['popupshowwccart'] ) && 1 == $options['popupshowwccart'] && is_cart() ) {
				$show_popup = true;
			}

			if ( isset( $options['popupshowwccheckout'] ) && 1 == $options['popupshowwccheckout'] && is_checkout() ) {
				$show_popup = true;
			}

			if ( isset( $options['popupshowwcaccount'] ) && 1 == $options['popupshowwcaccount'] && is_account_page() ) {
				$show_popup = true;
			}

			if ( isset( $options['popupshowwcproductcategory'] ) && 1 == $options['popupshowwcproductcategory'] && is_product_category() ) {
				$show_popup = true;
			}

			if ( isset( $options['popupshowwcproducttag'] ) && 1 == $options['popupshowwcproducttag'] && is_product_tag() ) {
				$show_popup = true;
			}

			// Check popup activation on single product pages
			if ( is_product() ) {
				// Check if popup is set to "All Products"
				$popupshowwcproducts_value = isset( $options['popupshowwcproducts'] ) ? $options['popupshowwcproducts'] : 0;

				if ( 1 == $popupshowwcproducts_value ) {
					$show_popup = true;
				} else {
					// Get the current queried object
					$current_object = get_queried_object();

					// Get the product categories for the current object
					$currentproductcategories = wp_get_post_terms( $current_object->ID, 'product_cat', array( 'fields' => 'ids' ) );

					// Get the product category IDs set with the plugin settings
					$includeproductcategories = isset( $options['popupshowproductcategories'] ) ? explode( ',', $options['popupshowproductcategories'] ) : array();

					if ( ! empty( array_intersect( $currentproductcategories, $includeproductcategories ) ) ) {
						$show_popup = true;
					}
				}
			}

			// Check popup activation on product category pages
			if ( is_product_category() ) {
				// Get the current category ID
				$currentproductcategory = array();
				$currentproductcategory[] = get_queried_object_id();

				// Get the product category IDs set with the plugin settings
				$includeproductcategories = isset( $options['popupshowproductcategories'] ) ? explode( ',', $options['popupshowproductcategories'] ) : array();

				if ( ! empty( array_intersect( $currentproductcategory, $includeproductcategories ) ) ) {
					$show_popup = true;
				}
			}
		}
	}

	if ( $show_popup ) {
		surbma_yes_no_popup_block();
	}
}, 999 );

function surbma_yes_no_popup_block() {
	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;

	$options = get_option( 'surbma_yes_no_popup_fields' );

	$popupimage_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupimage'] ) ? esc_url( $options['popupimage'] ) : '';
	$popuptitle_value = isset( $options['popuptitle'] ) ? wp_unslash( $options['popuptitle'] ) : '';
	$popuptext_value = isset( $options['popuptext'] ) ? wp_unslash( $options['popuptext'] ) : '';
	$popupbutton1text_value = isset( $options['popupbutton1text'] ) ? wp_unslash( $options['popupbutton1text'] ) : '';
	$popupbutton2text_value = isset( $options['popupbutton2text'] ) ? wp_unslash( $options['popupbutton2text'] ) : '';
	$popupbuttonurl_value = isset( $options['popupbuttonurl'] ) ? esc_url( $options['popupbuttonurl'] ) : '/';
	$popupbuttonoptions_value = isset( $options['popupbuttonoptions'] ) ? $options['popupbuttonoptions'] : 'button-1-redirect';

	$popupimagealignment_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupimagealignment'] ) ? $options['popupimagealignment'] : 'left';
	$popupbackgroundimage_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupbackgroundimage'] ) ? esc_url( $options['popupbackgroundimage'] ) : '';
	$popupoverlayopacity_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupoverlayopacity'] )
		? max( 0, min( 1, floatval( $options['popupoverlayopacity'] ) ) )
		: 0.6;
	$popupstyles_value = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
	$popupthemes_value = isset( $options['popupthemes'] ) && '' !== $options['popupthemes'] ? $options['popupthemes'] : 'normal';
	$popupdarkmode_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupdarkmode'] ) && 1 == $options['popupdarkmode'] ? ' surbma-yes-no-popup-dark' : '';
	$popupcentertext_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupcentertext'] ) && 1 == $options['popupcentertext'] ? ' surbma-yes-no-popup-text-center' : '';
	$popupverticalcenter_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupverticalcenter'] ) && 1 == $options['popupverticalcenter'] ? 'true' : 'false';
	$popuplarge_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popuplarge'] ) && 1 == $options['popuplarge'] ? ' uk-modal-dialog-large' : '';
	$popupbutton1style_value = isset( $options['popupbutton1style'] ) ? $options['popupbutton1style'] : 'default';
	$popupbutton2style_value = isset( $options['popupbutton2style'] ) ? $options['popupbutton2style'] : 'primary';
	$popupbuttonsize_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupbuttonsize'] ) ? $options['popupbuttonsize'] : 'large';
	$popupbuttonalignment_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupbuttonalignment'] ) ? $options['popupbuttonalignment'] : 'left';

	$popuphideloggedin_value = isset( $options['popuphideloggedin'] ) && 1 == $options['popuphideloggedin'] && is_user_logged_in() ? 1 : 0;
	$popupshownotloggedin_value = isset( $options['popupshownotloggedin'] ) && 1 == $options['popupshownotloggedin'] && ! is_user_logged_in() ? 1 : 0;
	$popuphidebutton2_value = isset( $options['popuphidebutton2'] ) && 1 == $options['popuphidebutton2'] ? 1 : 0;
	$popupdebug_value = isset( $options['popupdebug'] ) && 1 == $options['popupdebug'] ? 1 : 0;

	$popupclosebutton_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupclosebutton'] ) ? $options['popupclosebutton'] : 0;
	$popupclosekeyboard_value = ( 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && 1 == $popupdebug_value ) || ( isset( $options['popupclosekeyboard'] ) && 1 == $options['popupclosekeyboard'] ) ? 'true' : 'false';
	$popupclosebgclose_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupclosebgclose'] ) && 1 == $options['popupclosebgclose'] ? 'true' : 'false';
	$popupdelay_value = 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE && isset( $options['popupdelay'] ) ? $options['popupdelay'] : 0;
	$popupdelay_value = 1000 * (int) $popupdelay_value;
	$popupcookiedays_value = isset( $options['popupcookiedays'] ) && '' !== $options['popupcookiedays'] ? $options['popupcookiedays'] : 1;

	$modal_style = '';
	if ( 'full-page' !== $popupthemes_value && 'valid' === SURBMA_YES_NO_POPUP_PLUGIN_LICENSE ) {
		$modal_style .= 'background-color: rgba(0, 0, 0, ' . esc_attr( $popupoverlayopacity_value ) . ');';
	}
	if ( '' !== $popupbackgroundimage_value ) {
		$modal_style .= 'background-image: url(' . esc_url( $popupbackgroundimage_value ) . ');background-size: cover;background-repeat: no-repeat;';
	}
	?>
<input type="hidden" id="popuphideloggedin" value="<?php echo esc_attr( $popuphideloggedin_value ); ?>" />
<input type="hidden" id="popupshownotloggedin" value="<?php echo esc_attr( $popupshownotloggedin_value ); ?>" />
<input type="hidden" id="popupbuttonurl" value="<?php echo esc_attr( $popupbuttonurl_value ); ?>" />
<input type="hidden" id="popupdebug" value="<?php echo esc_attr( $popupdebug_value ); ?>" />
<script type="text/javascript">
	function surbma_ynp_openModal() {
		UIkit.modal(('#surbma-yes-no-popup'), {center: <?php echo esc_js( $popupverticalcenter_value ); ?>,keyboard: <?php echo esc_js( $popupclosekeyboard_value ); ?>,bgclose: <?php echo esc_js( $popupclosebgclose_value ); ?>}).show();
	}
	jQuery(document).ready(function($) {
		var show_modal = 0;
		var page_URL = $(location).attr("href");
		var popup_button_URL = $('#popupbuttonurl').val();

		// Always show Popup for NOT logged in users
		if ( $('#popupshownotloggedin').val() == '1' ) {
			show_modal = 1;
		// Check cookie
		} else if ( surbma_ynp_readCookie('surbma-yes-no-popup') != 'yes' ) {
			show_modal = 1;
		}

		// Hide popup if logged in
		if ( $('#popuphideloggedin').val() == '1' ) {
			show_modal = 0;
		// Hide popup on the redirected page
		} else if ( page_URL == popup_button_URL ) {
			show_modal = 0;
		}

		// Debug mode!!!
		if ( $('#popupdebug').val() == '1' ) {
			show_modal = 1;
		}

		if ( 1 == show_modal ) {
			setTimeout(function() {
				surbma_ynp_openModal();
			}, <?php echo (int) $popupdelay_value; ?>);
		}

		// console.log('page_URL: '+page_URL);
		// console.log('popup_button_URL: '+popup_button_URL);
		// console.log('show_modal: '+show_modal);
	});
</script>
<div id="surbma-yes-no-popup" class="uk-modal surbma-yes-no-popup-<?php echo esc_attr( $popupthemes_value ); ?><?php echo esc_attr( $popupdarkmode_value ); ?><?php echo esc_attr( $popupcentertext_value ); ?> surbma-yes-no-popup-<?php echo esc_attr( $popupstyles_value ); ?>"<?php echo '' !== $modal_style ? ' style="' . esc_attr( $modal_style ) . '"' : ''; ?>>
	<div class="uk-modal-dialog<?php echo esc_attr( $popuplarge_value ); ?>">
		<?php if ( 1 == $popupclosebutton_value ) { ?>
			<a class="uk-modal-close uk-close"></a>
		<?php } ?>
		<?php if ( '' !== $popupimage_value || '' !== $popuptitle_value ) { ?>
			<div class="uk-modal-header">
				<?php if ( '' !== $popupimage_value ) { ?>
					<p class="surbma-yes-no-popup-image-<?php echo esc_attr( $popupimagealignment_value ); ?>"><img src="<?php echo esc_url( $popupimage_value ); ?>" class="" alt="<?php echo esc_attr( $popuptitle_value ); ?>"></p>
				<?php } ?>
				<?php if ( '' !== $popuptitle_value ) { ?>
					<h2><a href="#"></a><?php echo esc_html( $popuptitle_value ); ?></h2>
				<?php } ?>
			</div>
		<?php } ?>
		<?php if ( '' !== $popuptext_value ) { ?>
			<div class="uk-modal-content"><?php echo wp_kses_post( $popuptext_value ); ?></div>
		<?php } ?>
		<div class="uk-modal-footer surbma-yes-no-popup-button-<?php echo esc_attr( $popupbuttonalignment_value ); ?>">
			<button id="surbma-ynp-button1" type="button" class="uk-button uk-button-<?php echo esc_attr( $popupbuttonsize_value ); ?> uk-button-<?php echo esc_attr( $popupbutton1style_value ); ?><?php if ( 'button-1-redirect' !== $popupbuttonoptions_value ) { echo ' uk-modal-close'; } ?>"><?php echo esc_html( $popupbutton1text_value ); ?></button>
			<?php if ( 1 != $popuphidebutton2_value ) { ?>
				<button id="surbma-ynp-button2" type="button" class="uk-button uk-button-<?php echo esc_attr( $popupbuttonsize_value ); ?> uk-button-<?php echo esc_attr( $popupbutton2style_value ); ?><?php if ( 'button-1-redirect' === $popupbuttonoptions_value ) { echo ' uk-modal-close'; } ?>"><?php echo esc_html( $popupbutton2text_value ); ?></button>
			<?php } ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function surbma_ynp_setCookie() {
		var d = new Date();
		d.setTime(d.getTime() + (<?php echo (int) $popupcookiedays_value; ?>*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = "surbma-yes-no-popup=yes;" + expires + ";path=/";
	}
	function surbma_ynp_readCookie(cookieName) {
		var re = new RegExp('[; ]'+cookieName+'=([^\\s;]*)');
		var sMatch = (' '+document.cookie).match(re);
		if (cookieName && sMatch) return unescape(sMatch[1]);
		return '';
	}
	<?php if ( 'button-1-redirect' !== $popupbuttonoptions_value ) { ?>
		(function() {
			var modal = document.getElementById('surbma-yes-no-popup');
			var btn1 = modal ? modal.querySelector('#surbma-ynp-button1') : null;
			var btn2 = modal ? modal.querySelector('#surbma-ynp-button2') : null;
			if ( btn1 ) {
				btn1.onclick = function () {
					surbma_ynp_setCookie();
				};
			}
			if ( btn2 ) {
				btn2.onclick = function () {
					location.href = "<?php echo esc_js( $popupbuttonurl_value ); ?>";
				};
			}
		})();
	<?php } else { ?>
		(function() {
			var modal = document.getElementById('surbma-yes-no-popup');
			var btn1 = modal ? modal.querySelector('#surbma-ynp-button1') : null;
			var btn2 = modal ? modal.querySelector('#surbma-ynp-button2') : null;
			if ( btn1 ) {
				btn1.onclick = function () {
					location.href = "<?php echo esc_js( $popupbuttonurl_value ); ?>";
				};
			}
			if ( btn2 ) {
				btn2.onclick = function () {
					surbma_ynp_setCookie();
				};
			}
		})();
	<?php } ?>
</script>
<?php
}
