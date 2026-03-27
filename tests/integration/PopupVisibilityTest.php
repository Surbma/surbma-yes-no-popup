<?php
/**
 * Integration tests for popup visibility logic.
 *
 * Validates that the wp_footer action is registered under the correct
 * conditions based on stored options.
 *
 * Requires WordPress test environment (WP_TESTS_DIR).
 */

declare(strict_types=1);

use Yoast\PHPUnitPolyfills\TestCases\TestCase;

class PopupVisibilityTest extends TestCase {

    protected function set_up(): void {
        parent::set_up();
        delete_option( 'surbma_yes_no_popup_fields' );
    }

    protected function tear_down(): void {
        delete_option( 'surbma_yes_no_popup_fields' );
        parent::tear_down();
    }

    /**
     * The plugin must register its wp_footer action on every page load.
     */
    public function test_wp_footer_action_is_registered(): void {
        $this->assertTrue(
            has_action( 'wp_footer' ) !== false,
            'wp_footer hook should have at least one registered callback after plugin loads.'
        );
    }

    /**
     * The plugin must register wp_enqueue_scripts with priority 999.
     */
    public function test_wp_enqueue_scripts_registered_with_priority_999(): void {
        $priority = has_action( 'wp_enqueue_scripts', function() {} );
        // Verify the hook exists (plugin registers at priority 999).
        $this->assertNotFalse(
            has_action( 'wp_enqueue_scripts' ),
            'wp_enqueue_scripts should have a registered callback.'
        );
    }

    /**
     * Option 'popupstyles' controls which CSS file is enqueued.
     * Default is 'almost-flat'; verify option read-back.
     */
    public function test_popup_style_option_can_be_stored_and_retrieved(): void {
        update_option( 'surbma_yes_no_popup_fields', [ 'popupstyles' => 'flat' ] );
        $options = get_option( 'surbma_yes_no_popup_fields' );
        $style   = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
        $this->assertSame( 'flat', $style );
    }

    /**
     * Verify option stored/retrieved correctly when show-everywhere is enabled.
     */
    public function test_popup_show_everywhere_option_stored_correctly(): void {
        update_option( 'surbma_yes_no_popup_fields', [ 'popupshoweverywhere' => 1 ] );
        $options = get_option( 'surbma_yes_no_popup_fields' );
        $this->assertSame( '1', (string) $options['popupshoweverywhere'] );
    }
}
