<?php
/**
 * Instagram Widget
 *
 * @package litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Instagram_Widget` doesn't exists yet.
if ( ! class_exists( 'Litho_Instagram_Widget' ) ) {
	/**
	 * Define Litho Instagram Widget class
	 */
	class Litho_Instagram_Widget extends WP_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			parent::__construct(
				'litho_instagram_widget',
				esc_html__( 'Litho Instagram', 'litho-addons' ),
				array(
					'description' => esc_html__( 'Add a custom instagram widget.', 'litho-addons' ),
				)
			);
		}
		/**
		 * Outputs the content for the current Litho Instagram widget instance.
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Litho Instagram widget instance.
		 */
		public function widget( $args, $instance ) {

			extract( $args ); // phpcs:ignore

			// Before widget.
			echo $args['before_widget']; // phpcs:ignore

			/* Define empty array */
			$instagram_extra_class = array();

			$column_classes = '';

			/* Get instagram new accessToken value */
			$instagram_new_access_token = isset( $instance['instagram_new_access_token'] ) ? $instance['instagram_new_access_token'] : '';

			/* Get no of column in grid type  */
			$no_of_columns_instagram_feed = isset( $instance['no_of_columns_instagram_feed'] ) ? $instance['no_of_columns_instagram_feed'] : '3';

			/* Get no of feed in grid type  */
			$no_instagram_feed = isset( $instance['no_instagram_feed'] ) ? $instance['no_instagram_feed'] : '6';

			/* Check if like disable or not */
			$litho_instagram_icon = ! empty( $instance['disable_instagram_like'] ) && 'on' == $instance['disable_instagram_like'] ? '' : '<div class="insta-counts"><span><i class="fa-brands fa-instagram"></i></span></div>';

			$litho_class_list           = ! empty( $instagram_extra_class ) ? implode( " ", sanitize_html_class( $instagram_extra_class ) ) : '';
			$litho_instagram_feed_class = ( $litho_class_list ) ? $litho_class_list . ' ' : '';

			$title = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : esc_html__( 'Follow Us @ Instagram', 'litho-addons' );

			if ( ! empty( $title ) ) {
				echo $args['before_title'] .  esc_attr( $title ) . $args['after_title']; // phpcs:ignore
			}

			$instagram_api_data = ! empty( $instagram_new_access_token ) ? wp_remote_get( 'https://graph.instagram.com/me/media?fields=id, caption,media_type,media_url,username,timestamp,permalink&access_token=' . $instagram_new_access_token, array( 'timeout' => 200 ) ) : '';


			if ( ! empty( $instagram_api_data ) && ! is_wp_error( $instagram_api_data ) || wp_remote_retrieve_response_code( $instagram_api_data ) === 200 ) {

				$instagram_api_data = json_decode( $instagram_api_data['body'] );

				switch ( $no_of_columns_instagram_feed ) {
					case '2':
						$column_classes .= 'row-cols-2 row-cols-sm-2 ';
						break;
					case '4':
						$column_classes .= 'row-cols-2 row-cols-xl-4 row-cols-lg-3 row-cols-sm-3 ';
						break;
					case '5':
						$column_classes .= 'row-cols-2 row-cols-xl-5 row-cols-lg-3 row-cols-sm-3 ';
						break;
					case '6':
						$column_classes .= 'row-cols-2 row-cols-xl-6 row-cols-lg-3 row-cols-sm-3 ';
						break;
					case '3':
					default:
						$column_classes .= 'row-cols-2 row-cols-lg-3 row-cols-sm-3 ';
						break;
				}
				?>
				<div class="litho-instagram-widget-wrap">
					<ul class="<?php echo esc_attr( $column_classes ) . esc_attr( $litho_instagram_feed_class ); ?>row instagram-feed">
						<?php
						if ( ! empty( $instagram_api_data->data ) ) {
							$i = 0;
							foreach ( $instagram_api_data->data as $key => $instagram_data ) {
								if ( $i < $no_instagram_feed ) {
									if ( 'IMAGE' == $instagram_data->media_type ) {
										$i++;
										?>
										<li class="grid-item grid-gutter">
											<figure>
												<a href="<?php echo esc_url( $instagram_data->permalink ); ?>" target="_blank">
													<img src="<?php echo esc_url( $instagram_data->media_url ); ?>" alt=""/>
													<?php echo sprintf( '%s', $litho_instagram_icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
												</a>
											</figure>
										</li>
										<?php
									}
								}
							}
						} else {
							echo '<li class="invalid-token">' . esc_html__( 'Please enter valid access token.', 'litho-addons' ) . '</li>';
						}
						?>
					</ul>
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

			/* Set up some default widget settings. */
			$defaults = array(
				'title'                        => esc_html__( 'Follow Us @ Instagram', 'litho-addons' ),
				'instagram_new_access_token'   => '',
				'no_of_columns_instagram_feed' => '3',
				'no_instagram_feed'            => 6,
				'disable_instagram_like'       => false,
			);
			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p class="show-new-instagram">
				<label for="<?php echo $this->get_field_id( '
					' ); ?>"><?php esc_html_e( 'Access token:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'instagram_new_access_token' ); ?>" name="<?php echo $this->get_field_name( 'instagram_new_access_token' ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram_new_access_token'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no_of_columns_instagram_feed' ) ); ?>"><?php esc_html_e( 'No. of column', 'litho-addons' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'no_of_columns_instagram_feed' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'no_of_columns_instagram_feed' ) ); ?>">
					<?php
					$options = array(
						'2' => esc_html__( '2', 'litho-addons' ),
						'3' => esc_html__( '3', 'litho-addons' ),
						'4' => esc_html__( '4', 'litho-addons' ),
						'5' => esc_html__( '5', 'litho-addons' ),
						'6' => esc_html__( '6', 'litho-addons' ),
						);
					?>
					<?php foreach ( $options as $option => $key ) : ?>
						<option value="<?php echo esc_attr( $option ); ?>"<?php $instance['no_of_columns_instagram_feed'] == $option ? selected( $instance['no_of_columns_instagram_feed'], $option ) : ''; ?>><?php echo esc_html( $key ); ?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'no_instagram_feed' ) ); ?>"><?php esc_html_e( 'No. of instagram feed', 'litho-addons' ); ?></label>
				<input type="number" min="1" max="20" name="<?php echo esc_attr( $this->get_field_name( 'no_instagram_feed' ) ); ?>" value="<?php echo esc_attr( $instance['no_instagram_feed'] ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'no_instagram_feed' ) ); ?>" />
			</p>
			<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['disable_instagram_like'], 'on' ); ?> id="<?php echo $this->get_field_id( 'disable_instagram_like' ); ?>" name="<?php echo $this->get_field_name( 'disable_instagram_like' ); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'disable_instagram_like' ) ); ?>"><?php esc_html_e( 'Disable instagram icon', 'litho-addons' ); ?></label>
			</p>
			<?php
		}

		/**
		 * Handles updating settings for the current Instagram widget instance.
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            About::form().
		 * @param array $old_instance Old settings for this instance.
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance                                 = array();
			$instance['title']                        = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['instagram_new_access_token']   = ( ! empty( $new_instance['instagram_new_access_token'] ) ) ? $new_instance['instagram_new_access_token'] : '';
			$instance['no_of_columns_instagram_feed'] = ( ! empty( $new_instance['no_of_columns_instagram_feed'] ) ) ? $new_instance['no_of_columns_instagram_feed'] : '';
			$instance['no_instagram_feed']            = ( ! empty( $new_instance['no_instagram_feed'] ) ) ? $new_instance['no_instagram_feed'] : '';
			$instance['disable_instagram_like']       = ( ! empty( $new_instance['disable_instagram_like'] ) ) ? $new_instance['disable_instagram_like'] : '';
			return $instance;
		}
	}
}

if ( ! function_exists( 'litho_load_instagram_widget' ) ) {
	/**
	 * Register and load the widget
	 */
	function litho_load_instagram_widget() {
		register_widget( 'Litho_Instagram_Widget' );
	}
}
add_action( 'widgets_init', 'litho_load_instagram_widget' );
