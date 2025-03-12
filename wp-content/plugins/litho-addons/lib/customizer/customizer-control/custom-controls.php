<?php
/**
 * Customizer Control: Custom Controls
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Separator_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Separator_Control' ) ) {

		class Litho_Customize_Separator_Control extends WP_Customize_Control {

			public $type = 'litho_separator';

			public function render_content() {

				if ( ! empty( $this->label ) ) :
					?>
					<label><h2><?php echo esc_html( $this->label ); ?></h2></label>
					<?php
				endif;
				if ( ! empty( $this->description ) ) :
					?>
					<div class="description customize-section-description"><?php echo esc_html( $this->description ); ?></div>
					<?php
				endif;
			}
		}
	}
}
