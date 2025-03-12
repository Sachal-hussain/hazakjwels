<?php
/**
 * About Me Widget
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_About_Widget` doesn't exists yet.
if ( ! class_exists( 'Litho_About_Widget' ) ) {

	/**
	 * Define Litho About Widget class
	 */
	class Litho_About_Widget extends WP_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct(
				'litho_about_widget',
				esc_html__( 'Litho About Me', 'litho-addons' ),
				array(
					'description' => esc_html__( 'Your site Author.', 'litho-addons' ),
				)
			);
		}
		/**
		 * Outputs the content for the current Litho About widget instance.
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Litho About widget instance.
		 */
		public function widget( $args, $instance ) {

			$litho_title = '';
			if ( isset( $instance['litho_title'] ) ) {
				$litho_title = apply_filters( 'widget_title', $instance['litho_title'] );
			}

			// Before widget.
			echo $args['before_widget']; // phpcs:ignore

			// Display the widget title if one was input (before and after defined by themes).
			if ( $litho_title ) {
				echo $args['before_title'] . esc_attr( $litho_title ) . $args['after_title']; // phpcs:ignore
			}

			$litho_author_image_url         = isset( $instance['litho_author_image_url'] ) ? $instance['litho_author_image_url'] : '';
			$litho_author_name              = isset( $instance['litho_author_name'] ) ? $instance['litho_author_name'] : '';
			$litho_author_designation       = isset( $instance['litho_author_designation'] ) ? $instance['litho_author_designation'] : '';
			$litho_author_short_description = isset( $instance['litho_author_short_description'] ) ? $instance['litho_author_short_description'] : '';
			$litho_author_short_description = apply_filters( 'widget_text', $litho_author_short_description, $instance, $this );
			$litho_author_link              = isset( $instance['litho_author_link'] ) ? $instance['litho_author_link'] : '';
			$litho_author_facebook          = isset( $instance['litho_author_facebook'] ) ? $instance['litho_author_facebook'] : '';
			$litho_author_dribbble          = isset( $instance['litho_author_dribbble'] ) ? $instance['litho_author_dribbble'] : '';
			$litho_author_twitter           = isset( $instance['litho_author_twitter'] ) ? $instance['litho_author_twitter'] : '';
			$litho_author_instagram         = isset( $instance['litho_author_instagram'] ) ? $instance['litho_author_instagram'] : '';

			if ( ! empty( $litho_author_image_url ) || ! empty( $litho_author_name ) || ! empty( $litho_author_designation ) || ! empty( $litho_author_short_description ) || ! empty( $litho_author_facebook ) || ! empty( $litho_author_dribbble ) || ! empty( $litho_author_twitter ) || ! empty( $litho_author_instagram ) ) {
				?>
				<div class="litho-about-me-wrapper about-me-wp-widget">
					<?php
					if ( ! empty( $litho_author_image_url ) ) {
						if ( esc_url( $litho_author_link ) ) {
							?>
							<a href="<?php echo esc_url( $litho_author_link ); ?>">
							<?php
						}
						?>
							<img class="about-image" src="<?php echo esc_url( $litho_author_image_url ); ?>" alt="<?php echo esc_attr__( 'Author Image', 'litho-addons' ); ?>"/>
						<?php
						if ( esc_url( $litho_author_link ) ) {
							?>
							</a>
							<?php
						}
					}
					if ( ! empty( $litho_author_name ) ) {
					?>
						<div class="author-name alt-font">
							<?php
							if ( esc_url( $litho_author_link ) ) {
								?>
								<a href="<?php echo esc_url( $litho_author_link ); ?>">
								<?php
							}

							echo esc_attr( $litho_author_name );

							if ( esc_url( $litho_author_link ) ) {
								?>
								</a>
								<?php
							}
							?>
						</div>
						<?php
					}
					if ( ! empty( $litho_author_designation ) ) {
						?>
						<span class="author-designation"><?php echo esc_html( $litho_author_designation ); ?></span>
						<?php
					}
					if ( ! empty( $litho_author_short_description ) ) {
						?>
						<p><?php echo esc_html( $litho_author_short_description ); ?></p>
						<?php
					}

					/**
					 * Fires immediately before Author Social Icon Wrapper Start
					 *
					 * @since 1.0
					 */
					do_action( 'litho_author_before_social_icon_wrapper' );

					if ( ! empty( $litho_author_facebook ) || ! empty( $litho_author_dribbble ) || ! empty( $litho_author_twitter ) || ! empty( $litho_author_instagram ) ) {
						?>
						<div class="social-icon-style-1 text-center">
							<ul class="extra-small-icon">
								<?php
								/**
								 * Fires immediately before Social Icon Start
								 *
								 * @since 1.0
								 */
								do_action( 'litho_author_before_social_icons' );

								if ( ! empty( $litho_author_facebook ) ) {
									?>
									<li>
										<a class="facebook" href="<?php echo esc_url( $litho_author_facebook ); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i><span></span>
										</a>
									</li>
									<?php
								}
								if ( ! empty( $litho_author_dribbble ) ) {
									?>
									<li>
										<a class="dribbble" href="<?php echo esc_url( $litho_author_dribbble ); ?>" target="_blank"><i class="fa-brands fa-dribbble"></i><span></span>
										</a>
									</li>
									<?php
								}
								if ( ! empty( $litho_author_twitter ) ) {
									?>
									<li>
										<a class="twitter" href="<?php echo esc_url( $litho_author_twitter ); ?>" target="_blank"><i class="fa-brands fa-x-twitter"></i><span></span>
										</a>
									</li>
									<?php
								}
								if ( ! empty( $litho_author_instagram ) ) {
									?>
									<li>
										<a class="instagram" href="<?php echo esc_url( $litho_author_instagram ); ?>" target="_blank"><i class="fa-brands fa-instagram"></i><span></span>
										</a>
									</li>
									<?php
								}
								/**
								 * Fires immediately after Social Icon End
								 *
								 * @since 1.0
								 */
								do_action( 'litho_author_after_social_icons' );
								?>
							</ul>
						</div>
						<?php
					}
					/**
					 * Fires immediately after Author Social Icon Wrapper End
					 *
					 * @since 1.0
					 */
					do_action( 'litho_author_after_social_icon_wrapper' );
					?>
				</div>
				<?php
			}
			// After widget.
			echo $args['after_widget']; // phpcs:ignore
		}

		/**
		 * Outputs the settings form for the widget.
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {

			$defaults = array(
				'litho_title'                    => esc_html__( 'About Me', 'litho-addons' ),
				'litho_author_image_url'         => '',
				'litho_author_name'              => '',
				'litho_author_designation'       => '',
				'litho_author_short_description' => '',
				'litho_author_link'              => '',
				'litho_author_facebook'          => '',
				'litho_author_dribbble'          => '',
				'litho_author_twitter'           => '',
				'litho_author_instagram'         => '',
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_title' ); ?>"><?php esc_html_e( 'Title:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_title' ); ?>" name="<?php echo $this->get_field_name( 'litho_title' ); ?>" type="text" value="<?php echo esc_attr( $instance['litho_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_author_image_url' ); ?>"><?php esc_html_e( 'Author image url:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_author_image_url' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_image_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['litho_author_image_url'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_name' ) ); ?>"><?php esc_html_e( 'Name:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_name' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_name' ); ?>" value="<?php echo esc_attr( $instance['litho_author_name'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_designation' ) ); ?>"><?php esc_html_e( 'Designation:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_designation' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_designation' ); ?>" value="<?php echo esc_attr( $instance['litho_author_designation'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_short_description' ) ); ?>"><?php esc_html_e( 'Short description:', 'litho-addons' ); ?></label>
				<textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'litho_author_short_description' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'litho_author_short_description' ) ); ?>"><?php echo esc_attr( $instance['litho_author_short_description'] ); ?></textarea>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_link' ) ); ?>"><?php esc_html_e( 'Link URL:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_link' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_link' ); ?>" value="<?php echo esc_attr( $instance['litho_author_link'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_facebook' ) ); ?>"><?php esc_html_e( 'Facebook:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_facebook' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_facebook' ); ?>" value="<?php echo esc_attr( $instance['litho_author_facebook'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_dribbble' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_dribbble' ); ?>" value="<?php echo esc_attr( $instance['litho_author_dribbble'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_twitter' ) ); ?>"><?php esc_html_e( 'Twitter:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_twitter' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_twitter' ); ?>" value="<?php echo esc_attr( $instance['litho_author_twitter'] ); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'litho_author_instagram' ) ); ?>"><?php esc_html_e( 'Instagram:', 'litho-addons' ); ?></label>
				<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'litho_author_instagram' ); ?>" name="<?php echo $this->get_field_name( 'litho_author_instagram' ); ?>" value="<?php echo esc_attr( $instance['litho_author_instagram'] ); ?>">
			</p>
			<?php
		}

		/**
		 * Handles updating settings for the current About widget instance.
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            About::form().
		 * @param array $old_instance Old settings for this instance.
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = array();

			$instance['litho_title']                    = ( ! empty( $new_instance['litho_title'] ) ) ? strip_tags( $new_instance['litho_title'] ) : '';
			$instance['litho_author_image_url']         = ( ! empty( $new_instance['litho_author_image_url'] ) ) ? strip_tags( $new_instance['litho_author_image_url'] ) : '';
			$instance['litho_author_name']              = ( ! empty( $new_instance['litho_author_name'] ) ) ? $new_instance['litho_author_name'] : '';
			$instance['litho_author_designation']       = ( ! empty( $new_instance['litho_author_designation'] ) ) ? $new_instance['litho_author_designation'] : '';
			$instance['litho_author_short_description'] = ( ! empty( $new_instance['litho_author_short_description'] ) ) ? $new_instance['litho_author_short_description'] : '';
			$instance['litho_author_link']              = ( ! empty( $new_instance['litho_author_link'] ) ) ? $new_instance['litho_author_link'] : '';
			$instance['litho_author_facebook']          = ( ! empty( $new_instance['litho_author_facebook'] ) ) ? $new_instance['litho_author_facebook'] : '';
			$instance['litho_author_dribbble']          = ( ! empty( $new_instance['litho_author_dribbble'] ) ) ? $new_instance['litho_author_dribbble'] : '';
			$instance['litho_author_twitter']           = ( ! empty( $new_instance['litho_author_twitter'] ) ) ? $new_instance['litho_author_twitter'] : '';
			$instance['litho_author_instagram']         = ( ! empty( $new_instance['litho_author_instagram'] ) ) ? $new_instance['litho_author_instagram'] : '';
			return $instance;
		}
	}
}

if ( ! function_exists( 'litho_load_about_widget' ) ) :
	/**
	 * Register and load the widget.
	 */
	function litho_load_about_widget() {
		register_widget( 'Litho_About_Widget' );
	}
endif;
add_action( 'widgets_init', 'litho_load_about_widget' );
