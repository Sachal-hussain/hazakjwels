<?php
/**
 * Customizer Control: Social Share Icons
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Customize_Post_Social_Share` doesn't exists yet.
	if ( ! class_exists( 'Litho_Customize_Post_Social_Share' ) ) {

		/**
		 * Define Litho_Customize_Post_Social_Share class
		 */
		class Litho_Customize_Post_Social_Share extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_post_social_icons';

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
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				}

				$multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
				?>
				<ul class="litho-post-social-icon-list">
					<?php
					$i = 0;
					$j = 0;
					foreach ( $this->choices as $value => $label ) {
						?>
						<li>
							<label>
								<?php
								if ( in_array( $value, $multi_values ) ) {
									$val         = $multi_values[ $j ];
									$val_checked = $multi_values[ $j + 1 ];
									$checked     = ( $val_checked == '1' ) ? 'checked' : '';
									$data_label  = $multi_values[ $j + 2 ];
								} else {
									$val         = $value;
									$val_checked = '0';
									$checked     = '';
									$data_label  = $label;
								}
								?>
								<input type="checkbox" <?php echo esc_html( $checked ); ?> class="customize-control-checkbox-social" value="<?php echo esc_attr( $val_checked ); ?>">
								<input type="text" class="customize-control-textbox-social <?php echo esc_attr( $val ); ?>" value="<?php echo esc_attr( $data_label ); ?>" data-value="<?php echo esc_attr( $val ); ?>" data-label="<?php echo esc_attr( $data_label ); ?>" readonly />
								<img src="<?php echo esc_url( LITHO_THEME_IMAGES_URI . '/move-icon.png' ); ?>" class="icon-move" alt="<?php echo esc_attr__( 'Move', 'litho' ); ?>" width="9" height="9">
							</label>
						</li>
						<?php
						$i++;
						if ( in_array( $value, $multi_values ) ) {
							$j = $j + 3;
						}
					}
					?>
				</ul>
				<input type="hidden" class="litho-post-social-icon-list" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
				<?php
			}
		}
	}
}
