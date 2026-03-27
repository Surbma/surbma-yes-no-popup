<?php
/**
 * PHPUnit bootstrap file for CPS | Age Verification plugin tests.
 *
 * Unit tests (tests/unit/) run standalone without WordPress.
 * Integration tests (tests/integration/) load the full WP test suite.
 */

// PHPUnit polyfills.
if ( file_exists( __DIR__ . '/../vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php' ) ) {
    require_once __DIR__ . '/../vendor/yoast/phpunit-polyfills/phpunitpolyfills-autoload.php';
}

// Detect suite.
$suite = '';
foreach ( $_SERVER['argv'] as $arg ) {
    if ( str_starts_with( $arg, '--testsuite' ) || in_array( $arg, [ 'unit', 'integration' ], true ) ) {
        $suite = $arg;
        break;
    }
}

if ( false !== strpos( $suite, 'unit' ) ) {
    require_once __DIR__ . '/stubs/wordpress-stubs.php';
    return;
}

// Integration: boot WordPress.
$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
    $_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( "$_tests_dir/includes/functions.php" ) ) {
    echo "Could not find $_tests_dir/includes/functions.php. Run bin/install-wp-tests.sh first." . PHP_EOL;
    exit( 1 );
}

require_once "$_tests_dir/includes/functions.php";

function _manually_load_age_verification_plugin() {
    require dirname( __DIR__ ) . '/surbma-yes-no-popup.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_age_verification_plugin' );

require "$_tests_dir/includes/bootstrap.php";
