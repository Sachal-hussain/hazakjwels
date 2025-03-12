<?php
namespace LithoAddons\Controls;

use Elementor\Base_Data_Control;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 *
 * Litho icon hover animation control.
 *
 * @package Litho
 */

if ( ! class_exists( 'LithoAddons\Controls\Icon_Hover_Animation' ) ) {

	/**
	 * Define Icon_Hover_Animation class
	 */
	class Icon_Hover_Animation extends Base_Data_Control {

		/**
		 * Animations.
		 *
		 * Holds all the available hover animation effects of the control.
		 *
		 * @access private
		 * @static
		 *
		 * @var array
		 */
		private static $litho_animations;

		/**
		 * Get icon hover animation control type.
		 *
		 * Retrieve the control type, in this case `icon-hover-animation`.
		 *
		 * @access public
		 *
		 * @return string Control type.
		 */
		public function get_type() {
			return 'icon-hover-animation';
		}

		/**
		 * Enqueue icon hover animation control scripts and styles.
		 *
		 * Used to register and enqueue custom scripts and styles used by the emoji one
		 * area control.
		 *
		 * @access public
		 */
		public function enqueue() {

			wp_register_script(
				'icon-hover-animation-control',
				LITHO_ADDONS_INCLUDES_DIR . '/assets/js/icon-hover-animation-control.js',
				[ 'jquery' ],
				LITHO_ADDONS_PLUGIN_VERSION,
				false
			);
			wp_enqueue_script( 'icon-hover-animation-control' );
		}

		/**
		 * Get animations.
		 *
		 * Retrieve the available hover animation effects.
		 *
		 * @access public
		 * @static
		 *
		 * @return array Available hover animation.
		 */
		public static function get_animations() {

			if ( is_null( self::$litho_animations ) ) {

				self::$litho_animations = [

					'icon-back'              => __( 'Icon Back', 'litho-addons' ),
					'icon-forward'           => __( 'Icon Forward', 'litho-addons' ),
					'icon-down'              => __( 'Icon Down', 'litho-addons' ),
					'icon-up'                => __( 'Icon Up', 'litho-addons' ),
					'icon-spin'              => __( 'Icon Spin', 'litho-addons' ),
					'icon-drop'              => __( 'Icon Drop', 'litho-addons' ),
					'icon-float-away'        => __( 'Icon Float Away', 'litho-addons' ),
					'icon-sink-away'         => __( 'Icon Sink Away', 'litho-addons' ),
					'icon-grow'              => __( 'Icon Grow', 'litho-addons' ),
					'icon-shrink'            => __( 'Icon Shrink', 'litho-addons' ),
					'icon-pulse'             => __( 'Icon Pulse', 'litho-addons' ),
					'icon-pulse-grow'        => __( 'Icon Pulse Grow', 'litho-addons' ),
					'icon-pulse-shrink'      => __( 'Icon Pulse Shrink', 'litho-addons' ),
					'icon-push'              => __( 'Icon Push', 'litho-addons' ),
					'icon-pop'               => __( 'Icon Pop', 'litho-addons' ),
					'icon-bounce'            => __( 'Icon Bounce', 'litho-addons' ),
					'icon-rotate'            => __( 'Icon Rotate', 'litho-addons' ),
					'icon-grow-rotate'       => __( 'Icon Grow Rotate', 'litho-addons' ),
					'icon-float'             => __( 'Icon Float', 'litho-addons' ),
					'icon-sink'              => __( 'Icon Sink', 'litho-addons' ),
					'icon-bob'               => __( 'Icon Bob', 'litho-addons' ),
					'icon-hang'              => __( 'Icon Hang', 'litho-addons' ),
					'icon-wobble-horizontal' => __( 'Icon Wobble Horizontal', 'litho-addons' ),
					'icon-wobble-vertical'   => __( 'Icon Wobble Vertical', 'litho-addons' ),
					'icon-buzz'              => __( 'Icon Buzz', 'litho-addons' ),
					'icon-buzz-out'          => __( 'Icon Buzz Out', 'litho-addons' ),
					'icon-sweep-bottom'      => __( 'Litho Icon Sweep To Bottom', 'litho-addons' ),
				];

				$litho_additional_animations = [];
				/**
				 * Element hover animations list.
				 *
				 * @param array $litho_additional_animations Additional Animations array.
				 */
				$litho_additional_animations = apply_filters( 'elementor/controls/icon_hover_animations/additional_animations', $litho_additional_animations );  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				self::$litho_animations      = array_merge( self::$litho_animations, $litho_additional_animations );
			}

			return self::$litho_animations;
		}

		/**
		 * Render icon hover animation control output in the editor.
		 *
		 * Used to generate the control HTML in the editor using Underscore JS
		 * template. The variables for the class are available using `data` JS
		 * object.
		 *
		 * @access public
		 */
		public function content_template() {
			$control_uid = $this->get_control_uid();
			?><div class="elementor-control-field">
				<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
				<div class="elementor-control-input-wrapper">
					<select id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-select2" type="select2" data-setting="{{ data.name }}">
						<option value=""><?php esc_html_e( 'None', 'litho-addons' ); ?></option>
						<?php
						foreach ( self::get_animations() as $animation_name => $animation_title ) :
							?>
							<option value="<?php echo esc_attr( $animation_name ); ?>">
							<?php echo esc_html( $animation_title ); ?>
							</option>
							<?php
						endforeach;
						?>
					</select>
				</div>
			</div>
			<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{ data.description }}}</div>
			<# } #>
			<?php
		}

		/**
		 * Get icon hover animation control default settings.
		 *
		 * Retrieve the default settings of the icon hover animation control. Used to return
		 * the default settings while initializing the icon hover animation control.
		 *
		 * @access protected
		 *
		 * @return array Control default settings.
		 */
		protected function get_default_settings() {
			return [
				'label_block' => true,
			];
		}
	}
}
