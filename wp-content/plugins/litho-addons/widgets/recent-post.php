<?php
/**
 * Recent Post Widget
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If class `Litho_Recent_Post_Widget` doesn't exists yet.
if ( ! class_exists( 'Litho_Recent_Post_Widget' ) ) {
	/**
	 * Define Litho Recent Post Widget class
	 */
	class Litho_Recent_Post_Widget extends WP_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {

			parent::__construct(
				'litho_recent_post_widget',
				esc_html__( 'Litho Recent Posts', 'litho-addons' ),
				array(
					'description' => esc_html__( 'Your site most recent posts.', 'litho-addons' ),
				)
			);
		}
		/**
		 * Outputs the content for the current Litho Recent Post widget instance.
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance Settings for the current Litho Recent Post widget instance.
		 */
		public function widget( $args, $instance ) {
			global $post;
			$litho_title = '';
			if ( isset( $instance['litho_title'] ) ) {
				$litho_title = apply_filters( 'widget_title', $instance['litho_title'] );
			}
			$litho_show_post_thumbnail = ( isset( $instance['litho_show_post_thumbnail'] ) ) ? $instance['litho_show_post_thumbnail'] : '';
			$litho_show_post_title     = ( isset( $instance['litho_show_post_title'] ) ) ? $instance['litho_show_post_title'] : '';
			$litho_show_post_date      = ( isset( $instance['litho_show_post_date'] ) ) ? $instance['litho_show_post_date'] : '';
			$litho_show_post_excerpt   = ( isset( $instance['litho_show_post_excerpt'] ) ) ? $instance['litho_show_post_excerpt'] : '';
			$litho_post_excerpt_length = ( isset( $instance['litho_post_excerpt_length'] ) ) ? $instance['litho_post_excerpt_length'] : '';
			$litho_post_date_format    = ( isset( $instance['litho_post_date_format'] ) ) ? $instance['litho_post_date_format']  : '';
			$litho_posts_per_page      = ( isset( $instance['litho_posts_per_page'] ) ) ? $instance['litho_posts_per_page'] : '3';
			$litho_post_order_by       = ( isset( $instance['litho_post_order_by'] ) ) ? $instance['litho_post_order_by'] : 'date';
			$litho_post_sort_by        = ( isset( $instance['litho_post_sort_by'] ) ) ? $instance['litho_post_sort_by'] : 'desc';

			echo $args['before_widget']; // phpcs:ignore

			if ( ! empty( $litho_title ) ) {
				echo $args['before_title'] . esc_attr( $litho_title ) . $args['after_title']; // phpcs:ignore
			}

			$litho_recent_post = array(
				'post_type'      => 'post',
				'posts_per_page' => $litho_posts_per_page,
				'orderby'        => $litho_post_order_by,
				'order'          => $litho_post_sort_by,
			);

			$litho_recent_posts = get_posts( $litho_recent_post );

			if ( ! empty( $litho_recent_posts ) ) { ?>
				<ul class="litho-recent-post-wrapper recent-post-wp-widget">
					<?php
					foreach ( $litho_recent_posts as $post ) { // phpcs:ignore
						setup_postdata( $post );
						?>
						<li class="media">
							<?php
							if ( has_post_thumbnail() && ( 'on' == $litho_show_post_thumbnail ) ) {
								?>
								<figure>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									</a>
								</figure>
								<?php
							}
							?>
							<div class="media-body">
								<?php
								if ( 'on' == $litho_show_post_title ) {
									?>
									<a class="recent-post-title" href="<?php the_permalink(); ?>">
										<span><?php the_title(); ?></span>
									</a>
									<?php
								}
								?>
								<?php
								if ( 'on' == $litho_show_post_date ) {
									?>
									<div class="recent-post-meta-date">
										<?php
										if ( $litho_post_date_format ) {
											echo get_the_date( $litho_post_date_format ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										} else {
											echo get_the_date(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										}
										?>
									</div>
								<?php } ?>
								<?php
								if ( 'on' == $litho_show_post_excerpt ) {
									$show_excerpt_grid = ! empty( $litho_post_excerpt_length ) ? litho_get_the_excerpt_theme( $litho_post_excerpt_length ) : litho_get_the_excerpt_theme( 8 );
									if ( $show_excerpt_grid ) {
										?>
										<div class="recent-post-content">
											<?php echo esc_html( $show_excerpt_grid ); ?>
										</div>
										<?php
									}
								}
								?>
							</div>
						</li>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
				<?php
			}

			echo $args['after_widget']; // phpcs:ignore
		}

		/**
		 * Outputs the settings form for the widget.
		 *
		 * @param array $instance Current settings.
		 */
		public function form( $instance ) {

			$instance = wp_parse_args(
				(array) $instance,
				array(
					'litho_title'               => '',
					'litho_show_post_thumbnail' => 'on',
					'litho_show_post_title'     => 'on',
					'litho_show_post_date'      => '',
					'litho_show_post_excerpt'   => 'on',
					'litho_post_excerpt_length' => '',
					'litho_post_date_format'    => '',
					'litho_posts_per_page'      => '3',
					'litho_post_order_by'       => 'date',
					'litho_post_sort_by'        => 'desc',
				)
			);

			$litho_title               = isset( $instance['litho_title'] ) ? $instance['litho_title'] : '';
			$litho_posts_per_page      = isset( $instance['litho_posts_per_page'] ) ? $instance['litho_posts_per_page'] : '3';
			$litho_show_post_thumbnail = ( isset( $instance['litho_show_post_thumbnail'] ) && 'on' == $instance['litho_show_post_thumbnail'] ) ? 'checked="checked"' : '';
			$litho_show_post_title     = ( isset( $instance['litho_show_post_title'] ) && 'on' == $instance['litho_show_post_title'] ) ? 'checked="checked"' : '';
			$litho_show_post_date      = ( isset( $instance['litho_show_post_date'] ) && 'on' == $instance['litho_show_post_date'] ) ? 'checked="checked"' : '';
			$litho_post_date_format    = ( isset( $instance['litho_post_date_format'] ) ) ? $instance['litho_post_date_format'] : '';
			$litho_show_post_excerpt   = ( isset( $instance['litho_show_post_excerpt'] ) && $instance['litho_show_post_excerpt'] == 'on' ) ? 'checked="checked"' : '';
			$litho_post_excerpt_length = isset( $instance['litho_post_excerpt_length'] ) ? $instance['litho_post_excerpt_length'] : '';
			$litho_post_order_by       = isset( $instance['litho_post_order_by'] ) ? $instance['litho_post_order_by'] : 'date';
			$litho_post_sort_by        = isset( $instance['litho_post_sort_by'] ) ? $instance['litho_post_sort_by'] : 'desc';
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_title' ); ?>"><?php esc_html_e( 'Title:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_title' ); ?>" name="<?php echo $this->get_field_name( 'litho_title' ); ?>" type="text" value="<?php echo esc_attr( $litho_title ); ?>" />
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_show_post_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'litho_show_post_thumbnail' ); ?>" type="checkbox" <?php echo $litho_show_post_thumbnail; ?> />
				<label for="<?php echo $this->get_field_id( 'litho_show_post_thumbnail' ); ?>">
					<?php esc_html_e( 'Display thumbnail?', 'litho-addons' ); ?>
				</label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_show_post_title' ); ?>" name="<?php echo $this->get_field_name( 'litho_show_post_title' ); ?>" type="checkbox" <?php echo $litho_show_post_title; ?> />
				<label for="<?php echo $this->get_field_id( 'litho_show_post_title' ); ?>">
					<?php esc_html_e( 'Display title?', 'litho-addons' ); ?>
				</label>
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_show_post_date' ); ?>" name="<?php echo $this->get_field_name( 'litho_show_post_date' ); ?>" type="checkbox" <?php echo $litho_show_post_date; ?> />
				<label for="<?php echo $this->get_field_id( 'litho_show_post_date' ); ?>">
					<?php esc_html_e( 'Display date?', 'litho-addons' ); ?>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_post_date_format' ); ?>">
					<?php esc_html_e( 'Date format:', 'litho-addons' ); ?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_post_date_format' ); ?>" name="<?php echo $this->get_field_name( 'litho_post_date_format' ); ?>" type="text" value="<?php echo esc_attr( $litho_post_date_format ); ?>" />
			</p>
			<p>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_show_post_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'litho_show_post_excerpt' ); ?>" type="checkbox" <?php echo $litho_show_post_excerpt; ?> />
				<label for="<?php echo $this->get_field_id( 'litho_show_post_excerpt' ); ?>">
					<?php esc_html_e( 'Display excerpt?', 'litho-addons' ); ?>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_post_excerpt_length' ); ?>">
					<?php esc_html_e( 'Excerpt length:', 'litho-addons' ); ?>
				</label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_post_excerpt_length' ); ?>" name="<?php echo $this->get_field_name( 'litho_post_excerpt_length' ); ?>" type="text" value="<?php echo esc_attr( $litho_post_excerpt_length ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_posts_per_page' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'litho-addons' ); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'litho_posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'litho_posts_per_page' ); ?>" type="text" value="<?php echo esc_attr( $litho_posts_per_page ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_post_order_by' ); ?>">
					<?php esc_html_e( 'Order by:', 'litho-addons' ); ?>
				</label>
				<select name="<?php echo $this->get_field_name( 'litho_post_order_by' ); ?>" class="widefat">
					<?php
					$order_options = array(
						'date'          => esc_html__( 'Date', 'litho-addons' ),
						'ID'            => esc_html__( 'ID', 'litho-addons' ),
						'title'         => esc_html__( 'Title', 'litho-addons' ),
						'modified'      => esc_html__( 'Modified Date', 'litho-addons' ),
						'rand'          => esc_html__( 'Random', 'litho-addons' ),
						'comment_count' => esc_html__( 'Comment count', 'litho-addons' ),
						'menu_order'    => esc_html__( 'Menu order', 'litho-addons' ),
					);
					?>
					<?php foreach ( $order_options as $option => $key ) { ?>
						<option value="<?php echo esc_attr( $option ); ?>"<?php $litho_post_order_by == $option ? selected( $litho_post_order_by, $option ) : ''; ?>><?php echo esc_html( $key ); ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'litho_post_sort_by' ); ?>">
					<?php esc_html_e( 'Sort order:', 'litho-addons' ); ?>
				</label>
				<select name="<?php echo $this->get_field_name( 'litho_post_sort_by' ); ?>" id="litho-recent-category" class="widefat">
					<?php
					$sort_by_options = array(
						'desc' => esc_html__( 'Descending', 'litho-addons' ),
						'asc'  => esc_html__( 'Ascending', 'litho-addons' ),
					);
					?>
					<?php foreach ( $sort_by_options as $option => $key ) { ?>
						<option value="<?php echo esc_attr( $option ); ?>"<?php $litho_post_sort_by == $option ? selected( $litho_post_sort_by, $option ) : ''; ?>><?php echo esc_html( $key ); ?></option>
					<?php } ?>
				</select>
			</p>
			<?php
		}

		/**
		 * Handles updating settings for the current Recent Post widget instance.
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            About::form().
		 * @param array $old_instance Old settings for this instance.
		 * @return array Updated settings to save.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance                              = array();
			$instance['litho_title']               = ( ! empty( $new_instance['litho_title'] ) ) ? strip_tags( $new_instance['litho_title'] ) : '';
			$instance['litho_posts_per_page']      = ( ! empty( $new_instance['litho_posts_per_page'] ) ) ? strip_tags( $new_instance['litho_posts_per_page'] ) : '';
			$instance['litho_show_post_title']     = ( ! empty( $new_instance['litho_show_post_title'] ) ) ? 'on' : '';
			$instance['litho_show_post_date']      = ( ! empty( $new_instance['litho_show_post_date'] ) ) ? 'on' : '';
			$instance['litho_post_date_format']    = ( ! empty( $new_instance['litho_post_date_format'] ) ) ? strip_tags( $new_instance['litho_post_date_format'] ) : '';
			$instance['litho_show_post_excerpt']   = ( ! empty( $new_instance['litho_show_post_excerpt'] ) ) ? 'on' : '';
			$instance['litho_post_excerpt_length'] = ( ! empty( $new_instance['litho_post_excerpt_length'] ) ) ? strip_tags( $new_instance['litho_post_excerpt_length'] ) : '';
			$instance['litho_post_order_by']       = ( ! empty( $new_instance['litho_post_order_by'] ) ) ? strip_tags( $new_instance['litho_post_order_by'] ) : '';
			$instance['litho_post_sort_by']        = ( ! empty( $new_instance['litho_post_sort_by'] ) ) ? strip_tags( $new_instance['litho_post_sort_by'] ) : '';
			$instance['litho_show_post_thumbnail'] = ( ! empty( $new_instance['litho_show_post_thumbnail'] ) ) ? strip_tags( $new_instance['litho_show_post_thumbnail'] ) : '';
			return $instance;
		}
	}
}

if ( ! function_exists( 'litho_load_recent_post_widget' ) ) {
	/**
	 * Register and load Litho custom widget
	 */
	function litho_load_recent_post_widget() {
		register_widget( 'Litho_Recent_Post_Widget' );
	}
}
add_action( 'widgets_init', 'litho_load_recent_post_widget' );
