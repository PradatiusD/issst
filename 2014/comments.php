
<?php if (get_comments_number() !=0) {

    echo "<hr>";
    wp_list_comments(array('style' => 'div')); 
    echo "<hr>";

}?>

<?php

	$args = array(
		'id_form'           => 'commentform',
		'id_submit'         => 'submit',
		'title_reply'       => __( 'Leave a Comment' ),
		'title_reply_to'    => __( 'Leave a Reply to %s' ),
		'cancel_reply_link' => __( 'Cancel Reply' ),
		'label_submit'      => __( 'Post Comment' ),

		'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
		'</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true">' .
		'</textarea></p>',

		'must_log_in' => '<p class="must-log-in">' .
		sprintf(
			__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
			wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . '</p>',

		'logged_in_as' => '<p class="logged-in-as">' .
		sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
			admin_url( 'profile.php' ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			) . '</p>',

		'comment_notes_before' => '<p class="comment-notes">' .
		__( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) .
		'</p>',

		'comment_notes_after' => '<p class="form-allowed-tags">' .
		sprintf(
			__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ),
			' <code>' . allowed_tags() . '</code>'
			) . '</p>',

		'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' =>
			'<p class="comment-form-author">' .
			'<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' /></p>',

			'email' =>
			'<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' /></p>',

			'url' =>
			'<p class="comment-form-url"><label for="url">' .
			__( 'Website', 'domainreference' ) . '</label>' .
			'<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" /></p>'
			)
		),
	);

	comment_form($args);

?>