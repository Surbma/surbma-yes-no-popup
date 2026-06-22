<?php

defined( 'ABSPATH' ) || exit;

function surbma_yes_no_popup_register_settings() {
	static $registered = false;

	if ( $registered ) {
		return;
	}

	$registered = true;

	register_setting(
		'surbma_yes_no_popup_options',
		'surbma_yes_no_popup_fields',
		'surbma_yes_no_popup_fields_validate'
	);

	global $popupbuttons_options, $popupbutton1sstyle_options, $popupbutton2sstyle_options;
	global $popupbuttonsize_options, $popupbuttonalignment_options, $popupimagealignment_options;
	global $popup_styles, $popup_themes;

	$popupbuttons_options = array(
		'button-1-redirect' => array(
			'value' => 'button-1-redirect',
			'label' => __( 'Button 1: Redirect / Button 2: Close', 'surbma-yes-no-popup' ),
		),
		'button-2-redirect' => array(
			'value' => 'button-2-redirect',
			'label' => __( 'Button 1: Close / Button 2: Redirect', 'surbma-yes-no-popup' ),
		),
	);

	$popupbutton1sstyle_options = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default', 'surbma-yes-no-popup' ),
		),
		'primary' => array(
			'value' => 'primary',
			'label' => __( 'Primary', 'surbma-yes-no-popup' ),
		),
		'success' => array(
			'value' => 'success',
			'label' => __( 'Success', 'surbma-yes-no-popup' ),
		),
		'danger' => array(
			'value' => 'danger',
			'label' => __( 'Danger', 'surbma-yes-no-popup' ),
		),
	);

	$popupbutton2sstyle_options = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default', 'surbma-yes-no-popup' ),
		),
		'primary' => array(
			'value' => 'primary',
			'label' => __( 'Primary', 'surbma-yes-no-popup' ),
		),
		'success' => array(
			'value' => 'success',
			'label' => __( 'Success', 'surbma-yes-no-popup' ),
		),
		'danger' => array(
			'value' => 'danger',
			'label' => __( 'Danger', 'surbma-yes-no-popup' ),
		),
	);

	$popupbuttonsize_options = array(
		'mini' => array(
			'value' => 'mini',
			'label' => __( 'Mini', 'surbma-yes-no-popup' ),
		),
		'small' => array(
			'value' => 'small',
			'label' => __( 'Small', 'surbma-yes-no-popup' ),
		),
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default', 'surbma-yes-no-popup' ),
		),
		'large' => array(
			'value' => 'large',
			'label' => __( 'Large', 'surbma-yes-no-popup' ),
		),
	);

	$popupbuttonalignment_options = array(
		'left' => array(
			'value' => 'left',
			'label' => __( 'Left', 'surbma-yes-no-popup' ),
		),
		'center' => array(
			'value' => 'center',
			'label' => __( 'Center', 'surbma-yes-no-popup' ),
		),
		'right' => array(
			'value' => 'right',
			'label' => __( 'Right', 'surbma-yes-no-popup' ),
		),
	);

	$popupimagealignment_options = array(
		'left' => array(
			'value' => 'left',
			'label' => __( 'Left', 'surbma-yes-no-popup' ),
		),
		'center' => array(
			'value' => 'center',
			'label' => __( 'Center', 'surbma-yes-no-popup' ),
		),
		'right' => array(
			'value' => 'right',
			'label' => __( 'Right', 'surbma-yes-no-popup' ),
		),
		'float-left' => array(
			'value' => 'float-left',
			'label' => __( 'Float Left', 'surbma-yes-no-popup' ),
		),
		'float-right' => array(
			'value' => 'float-right',
			'label' => __( 'Float Right', 'surbma-yes-no-popup' ),
		),
	);

	$popup_styles = array(
		'default' => array(
			'value' => 'default',
			'label' => __( 'Default Style', 'surbma-yes-no-popup' ),
		),
		'almost-flat' => array(
			'value' => 'almost-flat',
			'label' => __( 'Almost Flat Style', 'surbma-yes-no-popup' ),
		),
		'gradient' => array(
			'value' => 'gradient',
			'label' => __( 'Gradient Style', 'surbma-yes-no-popup' ),
		),
	);

	$popup_themes = array(
		'normal' => array(
			'value' => 'normal',
			'label' => __( 'Normal theme', 'surbma-yes-no-popup' ),
		),
		'full-page' => array(
			'value' => 'full-page',
			'label' => __( 'Full Page Theme', 'surbma-yes-no-popup' ),
		),
	);
}

function surbma_yes_no_popup_settings_page() {
	surbma_yes_no_popup_register_settings();
	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popupbuttonsize_options;
	global $popupbuttonalignment_options;
	global $popupimagealignment_options;
	global $popup_styles;
	global $popup_themes;

	$free_notification = 'free' === SURBMA_YES_NO_POPUP_PLUGIN_VERSION || 'valid' !== SURBMA_YES_NO_POPUP_PLUGIN_LICENSE ? '<div class="uk-alert uk-alert-danger uk-text-center" uk-alert><strong>' . esc_html__( 'Inactive options are available in the Premium Version of this plugin with an Active License.', 'surbma-yes-no-popup' ) . '</strong></div>' : '';
	$disabled = 'free' === SURBMA_YES_NO_POPUP_PLUGIN_VERSION || 'valid' !== SURBMA_YES_NO_POPUP_PLUGIN_LICENSE ? ' disabled' : '';

?>
<div class="cps-admin">
	<?php cps_admin_header( SURBMA_YES_NO_POPUP_PLUGIN_FILE ); ?>
	<div class="wrap">
		<?php if ( isset( $_GET['settings-updated'] ) && 'true' === $_GET['settings-updated'] ) { ?>
			<div class="updated notice is-dismissible"><p><strong><?php esc_html_e( 'Settings saved.' ); ?></strong></p></div>
		<?php } ?>

		<div class="uk-grid-small" uk-grid>
			<div class="uk-width-3-4@l">
				<form class="uk-form-horizontal" method="post" action="options.php">
					<?php settings_fields( 'surbma_yes_no_popup_options' ); ?>
					<?php
					$options = get_option( 'surbma_yes_no_popup_fields' );
					if ( ! is_array( $options ) ) {
						$options = array();
					}
					?>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Content', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-content"></a></h3>
						</div>
						<div id="popup-content" class="uk-card-body">
							<?php echo wp_kses_post( $free_notification ); ?>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupimage]"><?php _e( 'Popup Image', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<div class="uk-grid-small" uk-grid>
										<div class="uk-width-expand">
											<?php $popupimageValue = isset( $options['popupimage'] ) ? $options['popupimage'] : ''; ?>
											<input id="popupimage" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupimage]" value="<?php echo esc_url( wp_unslash( $popupimageValue ) ); ?>"<?php echo esc_attr( $disabled ); ?> />
										</div>
										<div class="uk-width-auto">
											<button id="upload-popupimage" class="uk-button uk-button-default uk-width-1-1"<?php echo esc_attr( $disabled ); ?>><span uk-icon="icon: image;ratio: .75"></span>&nbsp; <?php _e( 'Upload', 'surbma-yes-no-popup' ); ?></button>
										</div>
									</div>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptitle]"><?php _e( 'Popup Title', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popuptitleValue = isset( $options['popuptitle'] ) ? $options['popuptitle'] : ''; ?>
									<input id="popuptitle" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popuptitle]" value="<?php echo esc_attr( wp_unslash( $popuptitleValue ) ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popuptext]"><?php _e( 'Popup Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popuptextValue = isset( $options['popuptext'] ) ? $options['popuptext'] : ''; ?>
									<textarea id="popuptext" class="uk-textarea" cols="50" rows="10" name="surbma_yes_no_popup_fields[popuptext]"><?php echo esc_html( wp_unslash( $popuptextValue ) ); ?></textarea>
									<p><?php esc_html_e( 'Allowed HTML tags in this field', 'surbma-yes-no-popup' ); ?>:<br><pre><?php echo esc_html( implode( ', ', array_keys( wp_kses_allowed_html( 'post' ) ) ) ); ?></pre></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton1text]"><?php _e( 'Popup Button 1 Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupbutton1textValue = isset( $options['popupbutton1text'] ) ? $options['popupbutton1text'] : ''; ?>
									<input id="popupbutton1text" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton1text]" value="<?php echo esc_attr( wp_unslash( $popupbutton1textValue ) ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton2text]"><?php _e( 'Popup Button 2 Text', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupbutton2textValue = isset( $options['popupbutton2text'] ) ? $options['popupbutton2text'] : ''; ?>
									<input id="popupbutton2text" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbutton2text]" value="<?php echo esc_attr( wp_unslash( $popupbutton2textValue ) ); ?>" />
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonurl]"><?php _e( 'Popup Button Redirect URL', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupbuttonurlValue = isset( $options['popupbuttonurl'] ) ? $options['popupbuttonurl'] : ''; ?>
									<input id="popupbuttonurl" class="uk-input" type="url" name="surbma_yes_no_popup_fields[popupbuttonurl]" value="<?php echo esc_attr( wp_unslash( $popupbuttonurlValue ) ); ?>" />
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonoptions]"><?php _e( 'Popup Button Options', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbuttonoptions]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$selected = isset( $options['popupbuttonoptions'] ) ? $options['popupbuttonoptions'] : 'button-1-redirect';
											$p = '';
											$r = '';

											foreach ( $popupbuttons_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Design', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-design"></a></h3>
						</div>
						<div id="popup-design" class="uk-card-body">
							<?php echo wp_kses_post( $free_notification ); ?>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupimagealignment]"><?php _e( 'Image Alignment', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupimagealignment]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$popupimagealignmentValue = isset( $options['popupimagealignment'] ) ? $options['popupimagealignment'] : 'left';
											$selected = $popupimagealignmentValue;
											$p = '';
											$r = '';

											foreach ( $popupimagealignment_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbackgroundimage]"><?php _e( 'Popup Background', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<div class="uk-grid-small" uk-grid>
										<div class="uk-width-expand">
											<?php $popupbackgroundimageValue = isset( $options['popupbackgroundimage'] ) ? $options['popupbackgroundimage'] : ''; ?>
											<input id="popupbackgroundimage" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupbackgroundimage]" value="<?php echo esc_url( wp_unslash( $popupbackgroundimageValue ) ); ?>"<?php echo esc_attr( $disabled ); ?> />
										</div>
										<div class="uk-width-auto">
											<button id="upload-popupbackgroundimage" class="uk-button uk-button-default uk-width-1-1"<?php echo esc_attr( $disabled ); ?>><span uk-icon="icon: image;ratio: .75"></span>&nbsp; <?php _e( 'Upload', 'surbma-yes-no-popup' ); ?></button>
										</div>
									</div>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupoverlayopacity]"><?php _e( 'Overlay opacity', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupoverlayopacityValue = isset( $options['popupoverlayopacity'] ) ? $options['popupoverlayopacity'] : '0.6'; ?>
									<input id="popupoverlayopacity" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupoverlayopacity]" value="<?php echo esc_attr( $popupoverlayopacityValue ); ?>" min="0" max="1" step="0.1" placeholder="0.6"<?php echo esc_attr( $disabled ); ?> />
									<p class="uk-text-meta"><?php esc_html_e( 'Opacity of the black background overlay (0 = transparent, 1 = opaque). Default: 0.6', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupstyles]"><?php _e( 'Styles', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupstyles]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$popupstylesValue = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'default';
											$selected = $popupstylesValue;
											$p = '';
											$r = '';

											foreach ( $popup_styles as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupthemes]"><?php _e( 'Themes', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupthemes]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$selected = isset( $options['popupthemes'] ) ? $options['popupthemes'] : 'normal';
											$p = '';
											$r = '';

											foreach ( $popup_themes as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<div class="uk-form-label"><?php _e( 'Display options', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Dark mode', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupdarkmodeValue = isset( $options['popupdarkmode'] ) ? $options['popupdarkmode'] : 0; ?>
											<input id="popupdarkmode" name="surbma_yes_no_popup_fields[popupdarkmode]" type="checkbox" value="1" <?php checked( '1', $popupdarkmodeValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Center text alignment', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupcentertextValue = isset( $options['popupcentertext'] ) ? $options['popupcentertext'] : 0; ?>
											<input id="popupcentertext" name="surbma_yes_no_popup_fields[popupcentertext]" type="checkbox" value="1" <?php checked( '1', $popupcentertextValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Vertically center the Popup', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupverticalcenterValue = isset( $options['popupverticalcenter'] ) ? $options['popupverticalcenter'] : 0; ?>
											<input id="popupverticalcenter" name="surbma_yes_no_popup_fields[popupverticalcenter]" type="checkbox" value="1" <?php checked( '1', $popupverticalcenterValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Large modifier', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popuplargeValue = isset( $options['popuplarge'] ) ? $options['popuplarge'] : 0; ?>
											<input id="popuplarge" name="surbma_yes_no_popup_fields[popuplarge]" type="checkbox" value="1" <?php checked( '1', $popuplargeValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton1style]"><?php _e( 'Popup Button 1 Style', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbutton1style]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$selected = isset( $options['popupbutton1style'] ) ? $options['popupbutton1style'] : 'default';
											$p = '';
											$r = '';

											foreach ( $popupbutton1sstyle_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbutton2style]"><?php _e( 'Popup Button 2 Style', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbutton2style]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$selected = isset( $options['popupbutton2style'] ) ? $options['popupbutton2style'] : 'primary';
											$p = '';
											$r = '';

											foreach ( $popupbutton2sstyle_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonsize]"><?php _e( 'Button Size', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbuttonsize]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$popupbuttonsizeValue = isset( $options['popupbuttonsize'] ) ? $options['popupbuttonsize'] : 'large';
											$selected = $popupbuttonsizeValue;
											$p = '';
											$r = '';

											foreach ( $popupbuttonsize_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupbuttonalignment]"><?php _e( 'Button Alignment', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<select class="uk-select" name="surbma_yes_no_popup_fields[popupbuttonalignment]"<?php echo esc_attr( $disabled ); ?>>
										<?php
											$popupbuttonalignmentValue = isset( $options['popupbuttonalignment'] ) ? $options['popupbuttonalignment'] : 'left';
											$selected = $popupbuttonalignmentValue;
											$p = '';
											$r = '';

											foreach ( $popupbuttonalignment_options as $option ) {
												$label = $option['label'];
												if ( $selected == $option['value'] ) // Make default first in list
													$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
												else
													$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
											}
											echo $p . $r;
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Display', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-display"></a></h3>
						</div>
						<div id="popup-display" class="uk-card-body">
							<?php echo wp_kses_post( $free_notification ); ?>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Where to show PopUp?', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'EVERYWHERE', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupshoweverywhereValue = isset( $options['popupshoweverywhere'] ) ? $options['popupshoweverywhere'] : 0; ?>
											<input id="popupshoweverywhere" name="surbma_yes_no_popup_fields[popupshoweverywhere]" type="checkbox" value="1" <?php checked( '1', $popupshoweverywhereValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p><?php _e( 'Except on this page', 'surbma-yes-no-popup' ); ?>:
									<?php $popupexcepthereValue = isset( $options['popupexcepthere'] ) ? $options['popupexcepthere'] : null; ?>
									<input id="popupexcepthere" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupexcepthere]" value="<?php echo esc_attr( $popupexcepthereValue ); ?>" placeholder="ID" /> (<?php _e( 'You can give only ONE PAGE ID!', 'surbma-yes-no-popup' ); ?>)</p>
									<p class="uk-text-meta"><?php _e( 'If this option is enabled, all other options below will be ignored!', 'surbma-yes-no-popup' ); ?></p>
									<h4 class="uk-heading-divider"><?php _e( 'Special Pages', 'surbma-yes-no-popup' ); ?></h4>
									<p class="switch-wrap">
										<?php _e( 'Frontpage', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupshowfrontpageValue = isset( $options['popupshowfrontpage'] ) ? $options['popupshowfrontpage'] : 0; ?>
											<input id="popupshowfrontpage" name="surbma_yes_no_popup_fields[popupshowfrontpage]" type="checkbox" value="1" <?php checked( '1', $popupshowfrontpageValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Blog', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupshowblogValue = isset( $options['popupshowblog'] ) ? $options['popupshowblog'] : 0; ?>
											<input id="popupshowblog" name="surbma_yes_no_popup_fields[popupshowblog]" type="checkbox" value="1" <?php checked( '1', $popupshowblogValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Archive pages', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupshowarchiveValue = isset( $options['popupshowarchive'] ) ? $options['popupshowarchive'] : 0; ?>
											<input id="popupshowarchive" name="surbma_yes_no_popup_fields[popupshowarchive]" type="checkbox" value="1" <?php checked( '1', $popupshowarchiveValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<h4 class="uk-heading-divider"><?php _e( 'Single Pages', 'surbma-yes-no-popup' ); ?></h4>
									<?php
									foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
										$popupshowcpt = 'popupshowcpt-' . $post_type->name;
										?>
											<p class="switch-wrap">
												<?php echo __( 'All', 'surbma-yes-no-popup' ) . ' ' . $post_type->labels->name; ?>:
												<label class="switch">
													<?php $popupshowcptValue = isset( $options[$popupshowcpt] ) ? $options[$popupshowcpt] : 0; ?>
													<input id="<?php echo esc_attr( $popupshowcpt ); ?>" name="surbma_yes_no_popup_fields[<?php echo esc_attr( $popupshowcpt ); ?>]" type="checkbox" value="1" <?php checked( '1', $popupshowcptValue ); ?> />
													<span class="slider round"></span>
												</label>
											</p>
										<?php
									}
									?>
									<?php if ( class_exists( 'WooCommerce' ) ) { ?>
									<div class="<?php echo esc_attr( $disabled ); ?>">
										<h4 class="uk-heading-divider"><?php _e( 'WooCommerce Pages', 'surbma-yes-no-popup' ); ?></h4>
										<p class="switch-wrap">
											<?php _e( 'Shop page', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwcshopValue = isset( $options['popupshowwcshop'] ) ? $options['popupshowwcshop'] : 0; ?>
												<input id="popupshowwcshop" name="surbma_yes_no_popup_fields[popupshowwcshop]" type="checkbox" value="1" <?php checked( '1', $popupshowwcshopValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'Cart page', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwccartValue = isset( $options['popupshowwccart'] ) ? $options['popupshowwccart'] : 0; ?>
												<input id="popupshowwccart" name="surbma_yes_no_popup_fields[popupshowwccart]" type="checkbox" value="1" <?php checked( '1', $popupshowwccartValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'Checkout page', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwccheckoutValue = isset( $options['popupshowwccheckout'] ) ? $options['popupshowwccheckout'] : 0; ?>
												<input id="popupshowwccheckout" name="surbma_yes_no_popup_fields[popupshowwccheckout]" type="checkbox" value="1" <?php checked( '1', $popupshowwccheckoutValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'Customer account page', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwcaccountValue = isset( $options['popupshowwcaccount'] ) ? $options['popupshowwcaccount'] : 0; ?>
												<input id="popupshowwcaccount" name="surbma_yes_no_popup_fields[popupshowwcaccount]" type="checkbox" value="1" <?php checked( '1', $popupshowwcaccountValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'All', 'surbma-yes-no-popup' ); ?> <?php _e( 'Products', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwcproducts_value = isset( $options['popupshowwcproducts'] ) ? $options['popupshowwcproducts'] : 0; ?>
												<input id="popupshowwcproducts" name="surbma_yes_no_popup_fields[popupshowwcproducts]" type="checkbox" value="1" <?php checked( '1', $popupshowwcproducts_value ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'All', 'surbma-yes-no-popup' ); ?> <?php _e( 'Product category pages', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwcproductcategoryValue = isset( $options['popupshowwcproductcategory'] ) ? $options['popupshowwcproductcategory'] : 0; ?>
												<input id="popupshowwcproductcategory" name="surbma_yes_no_popup_fields[popupshowwcproductcategory]" type="checkbox" value="1" <?php checked( '1', $popupshowwcproductcategoryValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
										<p class="switch-wrap">
											<?php _e( 'All', 'surbma-yes-no-popup' ); ?> <?php _e( 'Product tag pages', 'surbma-yes-no-popup' ); ?>:
											<label class="switch">
												<?php $popupshowwcproducttagValue = isset( $options['popupshowwcproducttag'] ) ? $options['popupshowwcproducttag'] : 0; ?>
												<input id="popupshowwcproducttag" name="surbma_yes_no_popup_fields[popupshowwcproducttag]" type="checkbox" value="1" <?php checked( '1', $popupshowwcproducttagValue ); ?><?php echo esc_attr( $disabled ); ?> />
												<span class="slider round"></span>
											</label>
										</p>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowposts]"><?php _e( 'Posts & custom post types:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupshowpostsValue = isset( $options['popupshowposts'] ) ? $options['popupshowposts'] : null; ?>
									<input id="popupshowposts" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowposts]" value="<?php echo esc_attr( $popupshowpostsValue ); ?>" placeholder="Post & CPT IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'Any custom post type or normal post IDs can be given, except pages and attachments.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowpages]"><?php _e( 'Pages:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupshowpagesValue = isset( $options['popupshowpages'] ) ? $options['popupshowpages'] : null; ?>
									<input id="popupshowpages" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowpages]" value="<?php echo esc_attr( $popupshowpagesValue ); ?>" placeholder="Page IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'Only page IDs can be given.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowcategories]"><?php _e( 'Post categories:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupshowcategoriesValue = isset( $options['popupshowcategories'] ) ? $options['popupshowcategories'] : null; ?>
									<input id="popupshowcategories" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowcategories]" value="<?php echo esc_attr( $popupshowcategoriesValue ); ?>" placeholder="Post category IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'This will enable Popup on category archive pages and all single posts, that has the given category.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowtags]"><?php _e( 'Post tags:', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupshowtagsValue = isset( $options['popupshowtags'] ) ? $options['popupshowtags'] : null; ?>
									<input id="popupshowtags" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowtags]" value="<?php echo esc_attr( $popupshowtagsValue ); ?>" placeholder="Post tag IDs, comma separated" />
									<p class="uk-text-meta"><?php _e( 'This will enable Popup on tag archive pages and all single posts, that has the given tag.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<div class="uk-margin">
									<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowproductcategories]"><?php _e( 'Product categories:', 'surbma-yes-no-popup' ); ?></label>
									<div class="uk-form-controls">
										<?php $popupshowproductcategoriesValue = isset( $options['popupshowproductcategories'] ) ? $options['popupshowproductcategories'] : null; ?>
										<input id="popupshowproductcategories" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowproductcategories]" value="<?php echo esc_attr( $popupshowproductcategoriesValue ); ?>" placeholder="Product category IDs, comma separated"<?php echo esc_attr( $disabled ); ?> />
										<p class="uk-text-meta"><?php _e( 'This will enable Popup on product category archive pages and all single products, that has the given product category.', 'surbma-yes-no-popup' ); ?></p>
									</div>
								</div>
								<div class="uk-margin">
									<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupshowproducttags]"><?php _e( 'Product tags:', 'surbma-yes-no-popup' ); ?></label>
									<div class="uk-form-controls">
										<?php $popupshowproducttagsValue = isset( $options['popupshowproducttags'] ) ? $options['popupshowproducttags'] : null; ?>
										<input id="popupshowproducttags" class="uk-input" type="text" name="surbma_yes_no_popup_fields[popupshowproducttags]" value="<?php echo esc_attr( $popupshowproducttagsValue ); ?>" placeholder="Product tag IDs, comma separated"<?php echo esc_attr( $disabled ); ?> />
										<p class="uk-text-meta"><?php _e( 'This will enable Popup on product tag archive pages and all single products, that has the given product tag.', 'surbma-yes-no-popup' ); ?></p>
									</div>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<div class="uk-form-label"><?php _e( 'Membership mode', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Hide Popup for logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popuphideloggedinValue = isset( $options['popuphideloggedin'] ) ? $options['popuphideloggedin'] : 0; ?>
											<input id="popuphideloggedin" name="surbma_yes_no_popup_fields[popuphideloggedin]" type="checkbox" value="1" <?php checked( '1', $popuphideloggedinValue ); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Always show Popup for NOT logged in users', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupshownotloggedinValue = isset( $options['popupshownotloggedin'] ) ? $options['popupshownotloggedin'] : 0; ?>
											<input id="popupshownotloggedin" name="surbma_yes_no_popup_fields[popupshownotloggedin]" type="checkbox" value="1" <?php checked( '1', $popupshownotloggedinValue ); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'One button mode (Show only Popup Button 1)', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popuphidebutton2Value = isset( $options['popuphidebutton2'] ) ? $options['popuphidebutton2'] : 0; ?>
											<input id="popuphidebutton2" name="surbma_yes_no_popup_fields[popuphidebutton2]" type="checkbox" value="1" <?php checked( '1', $popuphidebutton2Value ); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
								</div>
							</div>
							<div class="uk-margin">
								<div class="uk-form-label"><?php _e( 'Debug mode', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Always show Popup', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupdebugValue = isset( $options['popupdebug'] ) ? $options['popupdebug'] : 0; ?>
											<input id="popupdebug" name="surbma_yes_no_popup_fields[popupdebug]" type="checkbox" value="1" <?php checked( '1', $popupdebugValue ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="uk-text-meta"><?php _e( 'If this option is enabled, Popup will always be visible, whatever button is clicked! Good for content testing.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>

					<div class="uk-card uk-card-small uk-card-default uk-card-hover uk-margin-bottom">
						<div class="uk-card-header uk-background-muted">
							<h3 class="uk-card-title"><?php _e( 'Popup Options', 'surbma-yes-no-popup' ); ?> <a class="uk-float-right uk-margin-small-top" uk-icon="icon: more-vertical" uk-toggle="target: #popup-options"></a></h3>
						</div>
						<div id="popup-options" class="uk-card-body">
							<?php echo wp_kses_post( $free_notification ); ?>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<div class="uk-form-label"><?php _e( 'Close options', 'surbma-yes-no-popup' ); ?></div>
								<div class="uk-form-controls">
									<p class="switch-wrap">
										<?php _e( 'Close button in popup', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupclosebuttonValue = isset( $options['popupclosebutton'] ) ? $options['popupclosebutton'] : 0; ?>
											<input id="popupclosebutton" name="surbma_yes_no_popup_fields[popupclosebutton]" type="checkbox" value="1" <?php checked( '1', $popupclosebuttonValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Close with keyboard (ESC button)', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupclosekeyboardValue = isset( $options['popupclosekeyboard'] ) ? $options['popupclosekeyboard'] : 0; ?>
											<input id="popupclosekeyboard" name="surbma_yes_no_popup_fields[popupclosekeyboard]" type="checkbox" value="1" <?php checked( '1', $popupclosekeyboardValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="switch-wrap">
										<?php _e( 'Close with a click on the background', 'surbma-yes-no-popup' ); ?>:
										<label class="switch">
											<?php $popupclosebgcloseValue = isset( $options['popupclosebgclose'] ) ? $options['popupclosebgclose'] : 0; ?>
											<input id="popupclosebgclose" name="surbma_yes_no_popup_fields[popupclosebgclose]" type="checkbox" value="1" <?php checked( '1', $popupclosebgcloseValue); ?><?php echo esc_attr( $disabled ); ?> />
											<span class="slider round"></span>
										</label>
									</p>
									<p class="uk-text-meta"><?php _e( 'Popup close without button click will never disable the popup. Popup will still load on every page.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupdelay]"><?php _e( 'Popup delay', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupdelayValue = isset( $options['popupdelay'] ) ? $options['popupdelay'] : 0; ?>
									<input id="popupdelay" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupdelay]" value="<?php echo $popupdelayValue; ?>" placeholder="0"<?php echo esc_attr( $disabled ); ?> /> <?php _e( 'seconds', 'surbma-yes-no-popup' ); ?>
								</div>
							</div>
							<div class="uk-margin<?php echo esc_attr( $disabled ); ?>">
								<label class="uk-form-label" for="surbma_yes_no_popup_fields[popupcookiedays]"><?php _e( 'Cookie expires in (days):', 'surbma-yes-no-popup' ); ?></label>
								<div class="uk-form-controls">
									<?php $popupcookiedaysValue = isset( $options['popupcookiedays'] ) ? $options['popupcookiedays'] : 1; ?>
									<input id="popupcookiedays" class="uk-input uk-form-width-small" type="number" name="surbma_yes_no_popup_fields[popupcookiedays]" value="<?php echo esc_attr( $popupcookiedaysValue ); ?>" placeholder="Days"<?php echo esc_attr( $disabled ); ?> />
									<p class="uk-text-meta"><?php _e( 'Default value is 1 day.', 'surbma-yes-no-popup' ); ?></p>
								</div>
							</div>
						</div>
						<div class="uk-card-footer">
							<p><input type="submit" class="uk-button uk-button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
						</div>
					</div>
				</form>
			</div>
			<div class="uk-width-1-4@l">
				<?php surbma_yes_no_popup_admin_sidebar(); ?>
			</div>
		</div>
		<div class="uk-margin-bottom" id="bottom"></div>
	</div>
	<?php cps_admin_footer( SURBMA_YES_NO_POPUP_PLUGIN_FILE ); ?>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
	$('#upload-popupimage').click(function(e) {
		e.preventDefault();
		var image = wp.media({
			title: 'Upload Image',
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$('#popupimage').val(image_url);
		});
	});
	$('#upload-popupbackgroundimage').click(function(e) {
		e.preventDefault();
		var image = wp.media({
			title: 'Upload Image',
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			console.log(uploaded_image);
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$('#popupbackgroundimage').val(image_url);
		});
	});
});
</script>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function surbma_yes_no_popup_fields_validate( $input ) {
	surbma_yes_no_popup_register_settings();
	global $popupbuttons_options;
	global $popupbutton1sstyle_options;
	global $popupbutton2sstyle_options;
	global $popupbuttonsize_options;
	global $popupbuttonalignment_options;
	global $popupimagealignment_options;
	global $popup_styles;
	global $popup_themes;

	$options = get_option( 'surbma_yes_no_popup_fields' );
	if ( ! is_array( $options ) ) {
		$options = array();
	}

	// Say our text option must be safe URL
	$input['popupbuttonurl'] = wp_filter_nohtml_kses( $input['popupbuttonurl'] );
	$input['popupbuttonurl'] = esc_url_raw( $input['popupbuttonurl'] );
	$input['popupimage'] = wp_filter_nohtml_kses( $input['popupimage'] );
	$input['popupimage'] = esc_url_raw( $input['popupimage'] );
	$input['popupbackgroundimage'] = wp_filter_nohtml_kses( $input['popupbackgroundimage'] );
	$input['popupbackgroundimage'] = esc_url_raw( $input['popupbackgroundimage'] );

	// Say our text option must be safe text with no HTML tags
	$input['popuptitle'] = wp_filter_nohtml_kses( $input['popuptitle'] );
	$input['popupbutton1text'] = wp_filter_nohtml_kses( $input['popupbutton1text'] );
	$input['popupbutton2text'] = wp_filter_nohtml_kses( $input['popupbutton2text'] );
	$input['popupshowpages'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowpages'] ) );
	$input['popupshowposts'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowposts'] ) );
	$input['popupshowcategories'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowcategories'] ) );
	$input['popupshowtags'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowtags'] ) );
	$input['popupshowproductcategories'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowproductcategories'] ) );
	$input['popupshowproducttags'] = wp_filter_nohtml_kses( str_replace( ' ', '', $input['popupshowproducttags'] ) );

	// Say our input option must be only numbers
	$input['popupexcepthere'] = isset( $input['popupexcepthere'] ) ? preg_replace( '/[^0-9]/', '', $input['popupexcepthere'] ) : null;
	$input['popupdelay'] = isset( $input['popupdelay'] ) ? preg_replace( '/[^0-9]/', '', $input['popupdelay'] ) : 0;
	$input['popupcookiedays'] = isset( $input['popupcookiedays'] ) ? preg_replace( '/[^0-9]/', '', $input['popupcookiedays'] ) : 1;

	$opacity = isset( $input['popupoverlayopacity'] ) ? floatval( $input['popupoverlayopacity'] ) : 0.6;
	$input['popupoverlayopacity'] = (string) max( 0, min( 1, $opacity ) );

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['popuptext'] = wp_filter_post_kses( $input['popuptext'] );

	// Checkbox validation.
	$input['popupdarkmode'] = isset( $input['popupdarkmode'] ) && $input['popupdarkmode'] == 1 ? 1 : 0;
	$input['popupcentertext'] = isset( $input['popupcentertext'] ) && $input['popupcentertext'] == 1 ? 1 : 0;
	$input['popupverticalcenter'] = isset( $input['popupverticalcenter'] ) && $input['popupverticalcenter'] == 1 ? 1 : 0;
	$input['popuplarge'] = isset( $input['popuplarge'] ) && $input['popuplarge'] == 1 ? 1 : 0;
	$input['popupshoweverywhere'] = isset( $input['popupshoweverywhere'] ) && $input['popupshoweverywhere'] == 1 ? 1 : 0;
	$input['popupshowfrontpage'] = isset( $input['popupshowfrontpage'] ) && $input['popupshowfrontpage'] == 1 ? 1 : 0;
	$input['popupshowblog'] = isset( $input['popupshowblog'] ) && $input['popupshowblog'] == 1 ? 1 : 0;
	$input['popupshowarchive'] = isset( $input['popupshowarchive'] ) && $input['popupshowarchive'] == 1 ? 1 : 0;
	$input['popupshowwcshop'] = isset( $input['popupshowwcshop'] ) && $input['popupshowwcshop'] == 1 ? 1 : 0;
	$input['popupshowwccart'] = isset( $input['popupshowwccart'] ) && $input['popupshowwccart'] == 1 ? 1 : 0;
	$input['popupshowwccheckout'] = isset( $input['popupshowwccheckout'] ) && $input['popupshowwccheckout'] == 1 ? 1 : 0;
	$input['popupshowwcaccount'] = isset( $input['popupshowwcaccount'] ) && $input['popupshowwcaccount'] == 1 ? 1 : 0;
	$input['popupshowwcproducts'] = isset( $input['popupshowwcproducts'] ) && $input['popupshowwcproducts'] == 1 ? 1 : 0;
	$input['popupshowwcproductcategory'] = isset( $input['popupshowwcproductcategory'] ) && $input['popupshowwcproductcategory'] == 1 ? 1 : 0;
	$input['popupshowwcproducttag'] = isset( $input['popupshowwcproducttag'] ) && $input['popupshowwcproducttag'] == 1 ? 1 : 0;
	$input['popupclosebutton'] = isset( $input['popupclosebutton'] ) && $input['popupclosebutton'] == 1 ? 1 : 0;
	$input['popupclosekeyboard'] = isset( $input['popupclosekeyboard'] ) && $input['popupclosekeyboard'] == 1 ? 1 : 0;
	$input['popupclosebgclose'] = isset( $input['popupclosebgclose'] ) && $input['popupclosebgclose'] == 1 ? 1 : 0;

	foreach ( get_post_types( array( 'public' => true, '_builtin' => false ), 'objects' ) as $post_type ) {
		$popupshowcpt = 'popupshowcpt-' . $post_type->name;
		$input[ $popupshowcpt ] = isset( $input[ $popupshowcpt ] ) && 1 == $input[ $popupshowcpt ] ? 1 : 0;
	}

	$input['popuphideloggedin'] = isset( $input['popuphideloggedin'] ) && $input['popuphideloggedin'] == 1 ? 1 : 0;
	$input['popupshownotloggedin'] = isset( $input['popupshownotloggedin'] ) && $input['popupshownotloggedin'] == 1 ? 1 : 0;
	$input['popuphidebutton2'] = isset( $input['popuphidebutton2'] ) && $input['popuphidebutton2'] == 1 ? 1 : 0;
	$input['popupdebug'] = isset( $input['popupdebug'] ) && $input['popupdebug'] == 1 ? 1 : 0;

	// Our select option must actually be in our array of select options
	if ( !array_key_exists( $input['popupbuttonoptions'], $popupbuttons_options ) )
		$input['popupbuttonoptions'] = 'button-1-redirect';
	if ( !array_key_exists( $input['popupbutton1style'], $popupbutton1sstyle_options ) )
		$input['popupbutton1style'] = 'default';
	if ( !array_key_exists( $input['popupbutton2style'], $popupbutton2sstyle_options ) )
		$input['popupbutton2style'] = 'primary';
	if ( !array_key_exists( $input['popupbuttonsize'], $popupbuttonsize_options ) )
		$input['popupbuttonsize'] = 'large';
	if ( !array_key_exists( $input['popupbuttonalignment'], $popupbuttonalignment_options ) )
		$input['popupbuttonalignment'] = 'left';
	if ( !array_key_exists( $input['popupimagealignment'], $popupimagealignment_options ) )
		$input['popupimagealignment'] = 'left';
	if ( !array_key_exists( $input['popupstyles'], $popup_styles ) )
		$input['popupstyles'] = 'default';
	if ( !array_key_exists( $input['popupthemes'], $popup_themes ) )
		$input['popupthemes'] = null;

	// If no valid license, check if field has any value. If yes, save it, if no, set to default.
	if ( 'free' === SURBMA_YES_NO_POPUP_PLUGIN_VERSION || 'valid' !== SURBMA_YES_NO_POPUP_PLUGIN_LICENSE ) {
		$input['popupimage'] = isset( $options['popupimage'] ) ? $options['popupimage'] : '';
		$input['popupbuttonoptions'] = isset( $options['popupbuttonoptions'] ) ? $options['popupbuttonoptions'] : 'button-1-redirect';

		$input['popupimagealignment'] = isset( $options['popupimagealignment'] ) ? $options['popupimagealignment'] : 'left';
		$input['popupbackgroundimage'] = isset( $options['popupbackgroundimage'] ) ? $options['popupbackgroundimage'] : '';
		$input['popupoverlayopacity'] = isset( $options['popupoverlayopacity'] ) ? $options['popupoverlayopacity'] : '0.6';
		$input['popupstyles'] = isset( $options['popupstyles'] ) ? $options['popupstyles'] : 'default';
		$input['popupthemes'] = isset( $options['popupthemes'] ) ? $options['popupthemes'] : 'normal';
		$input['popupdarkmode'] = isset( $options['popupdarkmode'] ) ? $options['popupdarkmode'] : 0;
		$input['popupcentertext'] = isset( $options['popupcentertext'] ) ? $options['popupcentertext'] : 0;
		$input['popupverticalcenter'] = isset( $options['popupverticalcenter'] ) ? $options['popupverticalcenter'] : 0;
		$input['popuplarge'] = isset( $options['popuplarge'] ) ? $options['popuplarge'] : 0;
		$input['popupbutton1style'] = isset( $options['popupbutton1style'] ) ? $options['popupbutton1style'] : 'default';
		$input['popupbutton2style'] = isset( $options['popupbutton2style'] ) ? $options['popupbutton2style'] : 'primary';
		$input['popupbuttonsize'] = isset( $options['popupbuttonsize'] ) ? $options['popupbuttonsize'] : 'large';
		$input['popupbuttonalignment'] = isset( $options['popupbuttonalignment'] ) ? $options['popupbuttonalignment'] : 'left';

		$input['popupshowproductcategories'] = isset( $options['popupshowproductcategories'] ) ? $options['popupshowproductcategories'] : '';
		$input['popupshowproducttags'] = isset( $options['popupshowproducttags'] ) ? $options['popupshowproducttags'] : '';
		$input['popupshowwcproducts'] = isset( $options['popupshowwcproducts'] ) ? $options['popupshowwcproducts'] : 0;

		$input['popuphideloggedin'] = isset( $options['popuphideloggedin'] ) ? $options['popuphideloggedin'] : 0;
		$input['popupshownotloggedin'] = isset( $options['popupshownotloggedin'] ) ? $options['popupshownotloggedin'] : 0;
		$input['popuphidebutton2'] = isset( $options['popuphidebutton2'] ) ? $options['popuphidebutton2'] : 0;

		$input['popupclosekeyboard'] = isset( $options['popupclosekeyboard'] ) ? $options['popupclosekeyboard'] : 0;
		$input['popupclosebgclose'] = isset( $options['popupclosebgclose'] ) ? $options['popupclosebgclose'] : 0;
		$input['popupdelay'] = isset( $options['popupdelay'] ) ? $options['popupdelay'] : 0;
		$input['popupcookiedays'] = isset( $options['popupcookiedays'] ) ? $options['popupcookiedays'] : 1;
	}

	return $input;
}
