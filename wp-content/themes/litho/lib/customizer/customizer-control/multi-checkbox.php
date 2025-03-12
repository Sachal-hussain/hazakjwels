<?php
/**
 * Customizer Control: Multiple Checkbox
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Checkbox_Multiple` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Checkbox_Multiple' ) ) {

		/**
		 * Define Litho_Customize_Checkbox_Multiple class
		 */
		class Litho_Customize_Checkbox_Multiple extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_checkbox_multiple';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {

				if ( empty( $this->choices ) ) {
					return;
				}
				if ( ! empty( $this->label ) ) {
					?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				}

				if ( ! empty( $this->description ) ) {
					?>
					<span class="description customize-control-description"><?php echo wp_kses( $this->description, wp_kses_allowed_html( 'post' ) ); ?></span>
					<?php
				}

				$multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
				?>
				<ul class="customize-control-checkbox-multiple">
					<li>
						<label><input type="checkbox" class="selectall" name="selectall"/>
						<?php echo esc_html__( 'Select All', 'litho' ); ?></label>
					</li>
					<?php foreach ( $this->choices as $value => $label ) { ?>
						<?php if ( ! empty( $value ) ) { ?>
							<li>
								<label><input type="checkbox" class="checkbox-field" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?>/> 
									<?php echo esc_html( $label ); ?></label>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
				<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
				<?php
			}
		}
	}
}
