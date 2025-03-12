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

	// If class `Litho_Customize_Image_SRCSET_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Image_SRCSET_Control' ) ) {

		/**
		 * Define Litho_Customize_Image_SRCSET_Control class
		 */
		class Litho_Customize_Image_SRCSET_Control extends WP_Customize_Control {
			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_image_srcset';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {

				// Hackily add in the data link parameter.
				$litho_srcset = litho_get_intermediate_image_sizes();

				if ( ! empty( $litho_srcset ) ) {
					?>
						<label>
							<?php if ( ! empty( $this->label ) ) : ?>
								<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
							<?php endif; ?>
							<select <?php $this->link(); ?>>
							<?php
							foreach ( $litho_srcset as $value => $label ) {
								?>
								<option value="<?php echo esc_attr( $label ); ?>" <?php echo selected( $this->value(), $value, false ); ?>>
									<?php
									$width  = '';
									$height = '';

									$litho_srcset_image_data = litho_get_image_size( $label );
									if ( isset( $litho_srcset_image_data['width'] ) ) {
										$width = ( 0 == $litho_srcset_image_data['width'] ) ? esc_html__( 'Auto', 'litho' ) : $litho_srcset_image_data['width'] . 'px';
									}
									if ( isset( $litho_srcset_image_data['height'] ) ) {
										$height = ( 0 == $litho_srcset_image_data['height'] ) ? esc_html__( 'Auto', 'litho' ) : $litho_srcset_image_data['height'] . 'px';
									}
									if ( 'full' == $label ) {
										echo esc_html__( 'Original Full Size', 'litho' );
									} else {
										$label = str_replace( array( '-', '_' ), array( ' ', ' ' ), esc_attr( $label ) );
										echo esc_html( ucwords( $label ) ) . ' (' . esc_attr( $width ) . ' X ' . esc_attr( $height ) . ')';
									}
									?>
								</option>
								<?php
							}
							?>
							</select>
						</label>
					<?php
				}
			}
		}
	}

	/**
	 * Preview Image Control
	 */
	// If class `Litho_Customize_Preview_Image_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Preview_Image_Control' ) ) {

		/**
		 * Define Litho_Customize_Preview_Image_Control class
		 */
		class Litho_Customize_Preview_Image_Control extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_preview_image';
			/**
			 * Preview Images
			 *
			 * @var array
			 */
			public $litho_img = array();
			/**
			 * Preview Images Columns
			 *
			 * @var string
			 */
			public $litho_columns = '4';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {

				if ( empty( $this->choices ) ) {
					return;
				}

				$name = '_customize-radio-' . $this->id;

				if ( ! empty( $this->label ) ) :
					?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				endif;
				if ( ! empty( $this->description ) ) :
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				endif;
				?>
				<ul class="litho-image-select litho-preview-image-column-<?php echo esc_attr( $this->litho_columns ); ?>">
					<?php
					$litho_img_counter = 0;
					foreach ( $this->choices as $value => $label ) :

						$active_class = ( $this->value() == $value ) ? ' active' : '';
						?>
						<li class="litho-preview-image<?php echo esc_attr( $active_class ); ?>">
						<label>
							<?php if ( ! empty( $this->litho_img[ $litho_img_counter ] ) ) : ?>
								<img title="<?php echo esc_attr( $label ); ?>" alt="<?php echo esc_attr( $label ); ?>" src="<?php echo esc_url( $this->litho_img[ $litho_img_counter ] ); ?>">
								<?php
							else :
								echo esc_html( $label );
							endif;
							?>
							<input type="radio" class="display-none" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); // phpcs:ignore ?> />
						</label>
						</li>
						<?php
						$litho_img_counter++;
					endforeach;
					?>
				</ul>
				<?php
			}
		}
	}

	/**
	 * Switch Control
	 */

	// If class `Litho_Customize_Switch_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Switch_Control' ) ) {

		/**
		 * Define Litho_Customize_Switch_Control class
		 */
		class Litho_Customize_Switch_Control extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_switch';

			/**
			 * Renders the control's content.
			 */
			public function render_content() {

				if ( empty( $this->choices ) ) {
					return;
				}

				$name = '_customize-radio-' . $this->id;

				if ( ! empty( $this->label ) ) :
					?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				endif;
				if ( ! empty( $this->description ) ) :
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				endif;
				?>
				<ul class="litho-switch-option">
					<?php
					$litho_switch_class = '';
					foreach ( $this->choices as $value => $label ) :

						$litho_switch_class  = ( 1 == $value ) ? 'litho-switch-option switch-option-enable' : 'litho-switch-option switch-option-disable';
						$litho_switch_class .= ( $this->value() == $value ) ? ' active' : '';
						?>
						<li class="<?php echo esc_attr( $litho_switch_class ); ?>">
						<label>
							<?php echo esc_html( $label ); ?>
							<input type="radio" class="display-none" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); // phpcs:ignore ?> />
						</label>
						</li>
						<?php
					endforeach;
					?>
				</ul>
				<?php
			}
		}
	}

	/**
	 * Separator Control
	 */

	// If class `Litho_Customize_Separator_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Separator_Control' ) ) {
		/**
		 * Define Litho_Customize_Separator_Control class
		 */
		class Litho_Customize_Separator_Control extends WP_Customize_Control {
			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_separator';

			/**
			 * Renders the control's content.
			 */
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
