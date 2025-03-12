<?php
/**
 * Alpha Color Picker Customizer Control
 *
 * This control adds a second slider for opacity to the stock WordPress color picker,
 * and it includes logic to seamlessly convert between RGBa and Hex color values as
 * opacity is added to or removed from a color.
 *
 * This Alpha Color Picker is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this Alpha Color Picker. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `WP_Customize_Control` exists.
if ( class_exists( 'WP_Customize_Control' ) ) {

	// If class `Litho_Alpha_Color_Control` doesn't exists yet.
	if ( ! class_exists( 'Litho_Alpha_Color_Control' ) ) {

		/**
		 * Define Litho_Alpha_Color_Control class
		 */
		class Litho_Alpha_Color_Control extends WP_Customize_Control {
			/**
			 * Customize control type.
			 *
			 * @var string
			 */
			public $type = 'alpha-color';
			/**
			 * Add support for palettes to be passed in.
			 *
			 * Supported palette values are true, false, or an array of RGBa and Hex colors.
			 *
			 * @var bool
			 */
			public $palette;
			/**
			 * Add support for showing the opacity value on the slider handle.
			 *
			 * @var bool
			 */
			public $show_opacity;
			/**
			 * Enqueue scripts and styles.
			 *
			 * Ideally these would get registered and given proper paths before this control object
			 * gets initialized, then we could simply enqueue them here, but for completeness as a
			 * stand alone class we'll register and enqueue them here.
			 */
			public function enqueue() {

				$litho_theme = wp_get_theme();

				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );

				wp_enqueue_script(
					'alpha-color-picker',
					LITHO_THEME_ADMIN_JS_URI . '/alpha-color-picker.js',
					array( 'jquery', 'wp-color-picker' ),
					$litho_theme->get( 'Version' ),
					true
				);
				wp_enqueue_style(
					'alpha-color-picker',
					LITHO_THEME_ADMIN_CSS_URI . '/alpha-color-picker.css',
					array( 'wp-color-picker' ),
					$litho_theme->get( 'Version' )
				);
			}
			/**
			 * Renders the control's content.
			 */
			public function render_content() {
				// Process the palette.
				if ( is_array( $this->palette ) ) {
					$palette = implode( '|', $this->palette );
				} else {
					// Default to true.
					$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
				}
				// Support passing show_opacity as string or boolean. Default to true.
				$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

				if ( isset( $this->label ) && '' !== $this->label ) {
					?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				}
				if ( isset( $this->description ) && '' !== $this->description ) {
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
					<?php
				}

				// Begin the output.
				?>
				<label>
					<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?> />
				</label>
				<?php
			}
		}
	}
}
