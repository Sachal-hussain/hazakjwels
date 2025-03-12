<?php
/**
 * Customizer Control: Custom Sidebars
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Custom_Sidebars` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Custom_Sidebars' ) ) {

		/**
		 * Define Litho_Customize_Custom_Sidebars class
		 */
		class Litho_Customize_Custom_Sidebars extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_custom_sidebar';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {
				?>
				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>

				<div id="litho_field_add_sidebar">
					<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
				</div>
				<ul id="add_li" class="add-custom-text-box"></ul>
				<input type="button" class="button button-primary add_more_sidebar" name="add_more_sidebar" value="<?php esc_attr_e( 'Add More', 'litho' ); ?>">
				<?php
			}
		}
	}
}
