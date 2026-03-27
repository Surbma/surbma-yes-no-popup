<?php
/**
 * Tests for CPS | Age Verification plugin constants and bootstrap.
 *
 * Runs standalone — no WordPress installation required.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PluginConstantsTest extends TestCase {

    public static function setUpBeforeClass(): void {
        require_once __DIR__ . '/../stubs/wordpress-stubs.php';

        if ( ! defined( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR' ) ) {
            require dirname( __DIR__, 2 ) . '/surbma-yes-no-popup.php';
        }
    }

    public function test_plugin_dir_constant_is_defined(): void {
        $this->assertTrue( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_DIR' ) );
        $this->assertDirectoryExists( SURBMA_YES_NO_POPUP_PLUGIN_DIR );
    }

    public function test_plugin_url_constant_is_defined(): void {
        $this->assertTrue( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_URL' ) );
        $this->assertStringContainsString( 'http', SURBMA_YES_NO_POPUP_PLUGIN_URL );
    }

    public function test_plugin_file_constant_is_defined(): void {
        $this->assertTrue( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_FILE' ) );
        $this->assertFileExists( SURBMA_YES_NO_POPUP_PLUGIN_FILE );
    }

    public function test_plugin_version_defaults_to_free_without_freemius(): void {
        $this->assertTrue( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_VERSION' ) );
        $this->assertSame( 'free', SURBMA_YES_NO_POPUP_PLUGIN_VERSION );
    }

    public function test_plugin_license_defaults_to_free_without_freemius(): void {
        $this->assertTrue( defined( 'SURBMA_YES_NO_POPUP_PLUGIN_LICENSE' ) );
        $this->assertSame( 'free', SURBMA_YES_NO_POPUP_PLUGIN_LICENSE );
    }

    public function test_main_file_has_plugin_name_header(): void {
        $content = file_get_contents( dirname( __DIR__, 2 ) . '/surbma-yes-no-popup.php' );
        $this->assertStringContainsString( 'Plugin Name:', $content );
        $this->assertStringContainsString( 'Age Verification', $content );
    }

    public function test_main_file_declares_text_domain(): void {
        $content = file_get_contents( dirname( __DIR__, 2 ) . '/surbma-yes-no-popup.php' );
        $this->assertStringContainsString( 'Text Domain: surbma-yes-no-popup', $content );
    }

    public function test_main_file_has_direct_access_guard(): void {
        $content = file_get_contents( dirname( __DIR__, 2 ) . '/surbma-yes-no-popup.php' );
        $this->assertStringContainsString( 'ABSPATH', $content );
    }
}
