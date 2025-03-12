<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}

$litho_post_within_content_area = litho_get_within_content_area();
$wrapper_tag                    = ( 1 == $litho_post_within_content_area ) ? 'div' : 'section';
?>
<<?php echo $wrapper_tag; ?> class="litho-comments-wrap"><?php // phpcs:ignore ?>
	<div class="container">
		<div class="row">
			<?php
			if ( $comments ) {
				?>
				<div class="comments" id="comments">
					<?php $comments_number = absint( get_comments_number() ); ?>
					<div class="comments-header section-inner small max-percentage">
						<h6 class="comment-reply-title alt-font">
							<?php
							if ( ! have_comments() ) {
								esc_html_e( 'Write a comment', 'litho' );
							} else {
								$comments_number = comments_number();
								?>
								<span class="comment-title"><?php echo esc_html( $comments_number ); ?></span>
							<?php } ?>
						</h6><!-- .comments-title -->
					</div><!-- .comments-header -->
					<ul class="blog-comment">
						<?php
							wp_list_comments(
								array(
									'style'       => 'li',
									'short_ping'  => true,
									'avatar_size' => 400,
									'callback'    => 'litho_comment_callback',
								)
							);
						?>
					</ul>
					<?php
					$comment_pagination = paginate_comments_links(
						array(
							'echo'      => false,
							'end_size'  => 0,
							'mid_size'  => 0,
							'next_text' => esc_html__( 'Newer Comments', 'litho' ) . ' <span aria-hidden="true">&rarr;</span>',
							'prev_text' => '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Older Comments', 'litho' ),
						)
					);

					if ( $comment_pagination ) {
						$pagination_classes = '';
						// If we're only showing the "Next" link, add a class indicating so.
						if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
							$pagination_classes = ' only-next';
						}
						?>
						<nav class="comments-pagination pagination<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Comments', 'litho' ); ?>">
							<?php echo wp_kses_post( $comment_pagination ); ?>
						</nav>
						<?php
					}
					?>
				</div><!-- comments -->
				<?php
			}

			if ( comments_open() || pings_open() ) {

				$commenter = wp_get_current_commenter();
				$args      = array();
				$args      = wp_parse_args( $args );
				if ( ! isset( $args['format'] ) ) {
					$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
				}

				$req      = get_option( 'require_name_email' );
				$html_req = ( $req ? " required='required'" : '' );
				$html5    = 'html5' === $args['format'];

				$required_text = sprintf(
					/* translators: %s: Asterisk symbol (*). */
					' ' . __( 'Required fields are marked %s', 'litho' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span class="required">*</span>'
				);
				$fields = array(
					'author' => sprintf(
						'<div class="row"><div class="col-md-6 col-sm-12 col-xs-12 comment-form-author">%s %s</div>',
						sprintf(
							'<label for="author">%s%s</label>',
							esc_html__( 'Your name', 'litho' ),
							( $req ? ' <span class="required">*</span>' : '' )
						),
						sprintf(
							'<input id="author" class="comment-field" name="author" type="text" value="%s" placeholder="%s" size="30" maxlength="245"%s />',
							esc_attr( $commenter['comment_author'] ),
							esc_html__( 'Enter your name', 'litho' ),
							$html_req
						)
					),
					'email'  => sprintf(
						'<div class="col-md-6 col-sm-12 col-xs-12 comment-form-email">%s %s</div>',
						sprintf(
							'<label for="email">%s%s</label>',
							esc_html__( 'Your email address', 'litho' ),
							( $req ? ' <span class="required">*</span>' : '' )
						),
						sprintf(
							'<input id="email" class="comment-field" name="email" %s value="%s" placeholder="%s" size="30" maxlength="100" aria-describedby="email-notes"%s />',
							( $html5 ? 'type="email"' : 'type="text"' ),
							esc_attr( $commenter['comment_author_email'] ),
							esc_html__( 'Enter your email', 'litho' ),
							$html_req
						)
					),
					'url'    => sprintf(
						'<div class="col-12 comment-form-url">%s %s</div>',
						sprintf(
							'<label for="url">%s</label>',
							esc_html__( 'Website', 'litho' )
						),
						sprintf(
							'<input id="url" class="comment-field" name="url" %s value="%s" placeholder="%s" size="30" maxlength="200" />',
							( $html5 ? 'type="url"' : 'type="text"' ),
							esc_attr( $commenter['comment_author_url'] ),
							esc_html__( 'Website', 'litho' )
						)
					),
				);

				if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
					$consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

					$fields['cookies'] = sprintf(
						'<div class="col-12 comment-form-cookies-consent">%s %s</div>',
						sprintf(
							'<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
							$consent
						),
						sprintf(
							'<label for="wp-comment-cookies-consent">%s</label>',
							esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'litho' )
						)
					);

					// Ensure that the passed fields include cookies consent.
					if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
						$args['fields']['cookies'] = $fields['cookies'];
					}
				}

				comment_form(
					array(
						'fields'               => $fields,
						'comment_field'        => sprintf(
							'<div class="col-12 comment-form-comment">%s %s</div>',
							sprintf(
								'<label for="comment">%s</label>',
								esc_html__( 'Your comment', 'litho' )
							),
							sprintf(
								'<textarea id="comment" class="comment-field" name="comment" placeholder="%s" cols="45" rows="8" maxlength="65525" required="required"></textarea>',
								esc_html__( 'Enter your comment', 'litho' )
							)
						),
						'comment_notes_before' => sprintf(
							'<div class="col-12 comment-notes">%s%s</div>',
							sprintf(
								'<span id="email-notes">%s</span>',
								esc_html__( 'Your email address will not be published.', 'litho' )
							),
							( $req ? $required_text : '' )
						),
						'class_form'           => 'litho-comment-form',
						'title_reply_before'   => '<h6 id="reply-title" class="comment-reply-title alt-font">',
						'title_reply_after'    => '</h6>',
						'title_reply'          => esc_html__( 'Write a comment', 'litho' ),
						'label_submit'         => esc_html__( 'POST COMMENT', 'litho' ),
						'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn" value="%4$s" />',
						'submit_field'         => '<div class="col-12 form-submit comment-button">%1$s %2$s</div></div>',
						'logged_in_as'         => '<div class="row"><p class="logged-in-as col-md-12">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'litho' ), esc_url( admin_url( 'profile.php' ) ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>', // phpcs:ignore
					)
				);

			} elseif ( is_single() ) {

				if ( $comments ) {
					?>
					<hr class="styled-separator is-style-wide" aria-hidden="true" />
					<?php
				}
				?>
				<div class="comment-respond" id="respond">
					<p class="comments-closed"><?php esc_html_e( 'Comments are closed.', 'litho' ); ?></p>
				</div><!-- #respond -->
				<?php
			}
			?>
		</div>
	</div>
</<?php echo $wrapper_tag; ?>><?php // phpcs:ignore ?>
