<?php

defined( 'ABSPATH' ) || exit;

// Include files.
require_once CPS_DIR . '/pages/plugins-page.php';

// Admin CPS menu
function cps_add_menus() {
	global $cps_plugins_page;
	$cps_plugins_page = add_menu_page(
		__( 'CPS Plugins', 'cps-sdk' ),
		__( 'CPS Plugins', 'cps-sdk' ),
		'manage_options',
		'cps-plugins-menu',
		'cps_plugins_page',
		CPS_URL . '/assets/images/cps-logo.svg',
		99
	);
	$cps_plugins_page = add_submenu_page(
		'cps-plugins-menu',
		__( 'All plugins', 'cps-sdk' ),
		__( 'All plugins', 'cps-sdk' ),
		'manage_options',
		'cps-plugins-menu',
		'cps_plugins_page'
	);
}
add_action( 'admin_menu', 'cps_add_menus' );

// Custom styles and scripts for admin pages
function cps_admin_enqueue_scripts( $hook ) {
	global $cps_plugins_page;
	if ( $hook === $cps_plugins_page ) {
		add_action( 'admin_enqueue_scripts', 'cps_admin_scripts', 9999 );
	}
}
add_action( 'admin_enqueue_scripts', 'cps_admin_enqueue_scripts' );

// Add inline CSS in the admin
function cps_admin_custom_admin_head() {
	// Remove Freemius promotional tab from admin pages.
	echo '<style>#pframe {display: none !important;}</style>';
}
add_action( 'admin_head', 'cps_admin_custom_admin_head' );
