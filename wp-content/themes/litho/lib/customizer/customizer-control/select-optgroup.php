<?php
/**
 * Customizer Control : Select control with optgroup
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Select_Optgroup` doesn't exists yet.
	if ( ! class_exists( 'Litho_Select_Optgroup' ) ) {
		/**
		 * Define Litho_Select_Optgroup class
		 */
		class Litho_Select_Optgroup extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_select';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {
				$input_id         = '_customize-input-' . $this->id;
				$description_id   = '_customize-description-' . $this->id;
				$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
				?>
				<?php if ( ! empty( $this->label ) ) : ?>
					<label for="<?php echo esc_attr( $input_id ); ?>" class="customize-control-title"><?php echo esc_html( $this->label ); ?></label>
				<?php endif; ?>
				<?php if ( ! empty( $this->description ) ) : ?>
					<span id="<?php echo esc_attr( $description_id ); ?>" class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>

				<select id="<?php echo esc_attr( $input_id ); ?>" <?php echo sprintf( '%s', $describedby_attr ); ?> <?php $this->link(); ?>><?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<option value=""><?php echo esc_html__( 'Select', 'litho' ); ?></option>
					<?php foreach ( $this->choices as $label => $values ) { ?>
						<optgroup label="<?php echo esc_attr( ucfirst( $label ) ); ?>">
							<?php foreach ( $values as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $this->value(), $value, false ); ?>><?php echo esc_html( $value ); ?></option>
							<?php } ?>
						</optgroup>
					<?php } ?>
				</select>
				<?php
			}
		}
	}
}
