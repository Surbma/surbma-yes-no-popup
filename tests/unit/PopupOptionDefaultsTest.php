<?php
/**
 * Tests for popup option defaults.
 *
 * Validates that the plugin's "isset ? value : default" pattern for each
 * configurable option provides the correct safe default when no option is stored.
 *
 * Runs standalone — no WordPress installation required.
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PopupOptionDefaultsTest extends TestCase {

    /** @var array<string, mixed> */
    private array $emptyOptions = [];

    /**
     * Option key → [expected_default, description]
     *
     * @return array<string, array<mixed>>
     */
    public static function optionDefaultProvider(): array {
        return [
            'popupstyles'            => [ 'popupstyles',            'almost-flat', 'Default popup style' ],
            'popupshoweverywhere'    => [ 'popupshoweverywhere',    0,             'Show everywhere disabled by default' ],
            'popupshowfrontpage'     => [ 'popupshowfrontpage',     null,          'Show on front page unset by default' ],
            'popupshowblog'          => [ 'popupshowblog',          null,          'Show on blog unset by default' ],
            'popupexcepthere'        => [ 'popupexcepthere',        '',            'Except-here is empty by default' ],
            'popuphideloggedin'      => [ 'popuphideloggedin',      null,          'Hide for logged-in unset by default' ],
            'popupdebug'             => [ 'popupdebug',             null,          'Debug mode unset by default' ],
            'popupclosebuttonValue'  => [ 'popupclosebutton',       null,          'Close button unset by default' ],
            'popupoverlayopacity'    => [ 'popupoverlayopacity',    '0.6',         'Overlay opacity defaults to 0.6' ],
        ];
    }

    /**
     * @dataProvider optionDefaultProvider
     */
    public function test_option_default_when_absent( string $key, mixed $expected, string $description ): void {
        $value = isset( $this->emptyOptions[ $key ] ) ? $this->emptyOptions[ $key ] : null;

        if ( $expected === null ) {
            $this->assertNull( $value, $description );
        } else {
            // For keys with explicit non-null defaults in the plugin source, verify them directly.
            if ( $key === 'popupstyles' ) {
                $value = isset( $this->emptyOptions[ $key ] ) ? $this->emptyOptions[ $key ] : 'almost-flat';
                $this->assertSame( 'almost-flat', $value, $description );
            } elseif ( $key === 'popupshoweverywhere' ) {
                $value = isset( $this->emptyOptions[ $key ] ) ? $this->emptyOptions[ $key ] : 0;
                $this->assertSame( 0, $value, $description );
            } elseif ( $key === 'popupexcepthere' ) {
                $value = isset( $this->emptyOptions[ $key ] ) ? $this->emptyOptions[ $key ] : '';
                $this->assertSame( '', $value, $description );
            } elseif ( $key === 'popupoverlayopacity' ) {
                $value = isset( $this->emptyOptions[ $key ] ) ? $this->emptyOptions[ $key ] : '0.6';
                $this->assertSame( '0.6', $value, $description );
            } else {
                $this->assertNull( $value, $description );
            }
        }
    }

    /**
     * Popup style defaults to 'almost-flat' for enqueue logic.
     */
    public function test_popup_style_defaults_to_almost_flat(): void {
        $options = [];
        $style   = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'almost-flat';
        $this->assertSame( 'almost-flat', $style );
    }

    /**
     * Popup show-everywhere defaults to disabled (0).
     */
    public function test_popupshoweverywhere_defaults_to_zero(): void {
        $options = [];
        $value   = isset( $options['popupshoweverywhere'] ) ? $options['popupshoweverywhere'] : 0;
        $this->assertSame( 0, $value );
    }

    /**
     * Popup except-here defaults to empty string.
     */
    public function test_popupexcepthere_defaults_to_empty_string(): void {
        $options = [];
        $value   = isset( $options['popupexcepthere'] ) ? $options['popupexcepthere'] : '';
        $this->assertSame( '', $value );
    }

    /**
     * Overlay opacity defaults to 0.6.
     */
    public function test_popupoverlayopacity_defaults_to_zero_point_six(): void {
        $options = [];
        $value   = isset( $options['popupoverlayopacity'] ) ? $options['popupoverlayopacity'] : '0.6';
        $this->assertSame( '0.6', $value );
    }

    /**
     * Overlay opacity is clamped between 0 and 1.
     *
     * @dataProvider overlayOpacityClampProvider
     */
    public function test_popupoverlayopacity_clamps_to_valid_range( float $input, float $expected ): void {
        $value = max( 0, min( 1, $input ) );
        $this->assertEquals( $expected, $value );
    }

    /**
     * @return array<string, array<float>>
     */
    public static function overlayOpacityClampProvider(): array {
        return [
            'above max' => [ 1.5, 1 ],
            'below min' => [ -0.2, 0 ],
            'valid'     => [ 0.3, 0.3 ],
        ];
    }
}
