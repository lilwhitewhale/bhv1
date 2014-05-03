<?php do_action( 'bp_before_member_activity_post_form' ) ?>

<?php if ( is_user_logged_in() && bp_is_my_profile() && ( '' == bp_current_action() || 'just-me' == bp_current_action() ) ) : ?>
	<?php /*locate_template( array( 'activity/post-form.php'), true )*/ ?>
<?php endif; ?>

<?php do_action( 'bp_after_member_activity_post_form' ) ?>
<?php do_action( 'bp_before_member_activity_content' ) ?>



<?php do_action( 'bp_after_member_activity_content' ) ?>
