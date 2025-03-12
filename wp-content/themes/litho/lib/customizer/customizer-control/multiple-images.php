<?php
/**
 * Customizer Control: Multiple Images
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Multiple_Image` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Multiple_Image' ) ) {

		/**
		 * Define Litho_Customize_Multiple_Image class
		 */
		class Litho_Customize_Multiple_Image extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_multiple_image';

			/**
			 * Renders the control's content.
			 */
			public function render_content() { ?>

				<?php if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>

				<?php $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

				<div class="litho_description_box">
					<div class="multiple_images">
						<?php
						foreach ( $multi_values as $key => $value ) {
							if ( ! empty( $value ) ) :
								$litho_image_url = wp_get_attachment_url( $value );
								?>
								<div id="<?php echo esc_attr( $value ); ?>">
									<img class="upload_image_screenshort_multiple width-100px" src="<?php echo esc_url( $litho_image_url ); ?>" />
									<a href="javascript:void(0)" class="remove"><?php echo esc_html__( 'Remove', 'litho' ); ?></a>
								</div>
								<?php
							endif;
						}
						?>
					</div>
					<input class="litho_upload_button_multiple_customizer" id="litho_upload_button_multiple_customizer" type="button" value="<?php echo esc_attr__( 'Browse', 'litho' ); ?>" /><?php echo esc_html__( ' Select Files', 'litho' ); ?>
				</div>
				<input type="hidden" class="upload_field_multiple_customizer" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
				<?php
			}
		}
	}
}
