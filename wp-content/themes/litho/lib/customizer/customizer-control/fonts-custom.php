<?php
/**
 * Customizer Control: Custom Fonts
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Custom_Font` doesn't exists yet.
	if ( ! class_exists( 'Litho_Custom_Font' ) ) {

		/**
		 * Define Litho_Custom_Font class
		 */
		class Litho_Custom_Font extends WP_Customize_Control {

			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'litho_custom_fonts_list';

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
				<div id="litho_custom_fonts">
					<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>">
				</div>
				<div class="add-custom-font">
					<?php
					$get_custom_fonts = json_decode( $this->value(), true );
					if ( is_array( $get_custom_fonts ) && ! empty( $get_custom_fonts ) ) {
						foreach ( $get_custom_fonts as $custom_fonts_val_key => $custom_fonts_val_arr ) {
							?>
							<ul class="custom-font">
								<?php
								foreach ( $custom_fonts_val_arr as $key => $val ) {
									switch ( $key ) {
										case '0':
											?>
											<li>
												<label><?php esc_html_e( 'Font Family', 'litho' ); ?></label>
												<input type="text" class="font-family" value="<?php echo esc_attr( $val ); ?>"/>
												<span class="font-family-decription"><em><?php esc_html_e( 'Allowed only characters & spaces. Ex : Poster Bodani', 'litho' ); ?></em></span>
											</li>
											<?php
											break;
										case '1':
											?>
											<li>
												<label><?php esc_html_e( 'WOFF2', 'litho' ); ?></label>
												<input type="text" class="upload_field type-woff2" id="litho_upload" value="<?php echo esc_attr( $val ); ?>" />
												<div class="custom-font-upload-button">
													<i class="dashicons dashicons-upload"></i>
													<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="woff2" data-mime_type="font/woff2,application/octet-stream,font/x-woff2"/>
												</div>
											</li>
											<?php
											break;
										case '2':
											?>
											<li>
												<label><?php esc_html_e( 'WOFF', 'litho' ); ?></label>
												<input type="text" class="upload_field type-woff" id="litho_upload" value="<?php echo esc_attr( $val ); ?>" />
												<div class="custom-font-upload-button">
													<i class="dashicons dashicons-upload"></i>
													<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="woff" data-mime_type="font/woff,application/font-woff,application/x-font-woff,application/octet-stream"/>
												</div>
											</li>
											<?php
											break;
										case '3':
											?>
											<li>
												<label><?php esc_html_e( 'TTF', 'litho' ); ?></label>
												<input type="text" class="upload_field type-ttf" id="litho_upload" value="<?php echo esc_attr( $val ); ?>" />
												<div class="custom-font-upload-button">
													<i class="dashicons dashicons-upload"></i>
													<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="ttf" data-mime_type="application/x-font-ttf,application/octet-stream,font/ttf"/>
												</div>
											</li>
											<?php
											break;
										case '4':
											?>
											<li>
												<label><?php esc_html_e( 'EOT', 'litho' ); ?></label>
												<input type="text" class="upload_field type-eot" id="litho_upload" value="<?php echo esc_attr( $val ); ?>" />
												<div class="custom-font-upload-button">
													<i class="dashicons dashicons-upload"></i>
													<input id="file" name="file" type="file" class="litho_font_upload_button" data-font_type="eot" data-mime_type="application/vnd.ms-fontobject,application/octet-stream,application/x-vnd.ms-fontobject"/>
												</div>
											</li>
											<?php
											break;
									}
								}
								?>
								<li>
									<input type="button" class="button button-secondary remove-custom-font" value="<?php echo esc_attr__( 'Remove font', 'litho' ); ?>">
								</li>
							</ul>
							<?php
						}
					}
					?>
				</div>
				<input type="button" class="button button-primary add_more_fonts" name="add_more_fonts" value="<?php echo esc_attr__( 'Add more font', 'litho' ); ?>">
				<?php
			}
		}
	}
}
