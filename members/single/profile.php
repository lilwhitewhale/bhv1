<?php do_action( 'bp_before_profile_content' ) ?>

<div class="profile clearfix">
	<?php if ( 'edit' == bp_current_action() ) : ?>
		<?php locate_template( array( 'members/single/profile/edit.php' ), true ) ?>

	<?php elseif ( 'change-avatar' == bp_current_action() ) : ?>
		<?php locate_template( array( 'members/single/profile/change-avatar.php' ), true ) ?>

	<?php else : ?>
		<?php locate_template( array( 'members/single/profile/profile-loop.php' ), true ) ?>

	<?php endif; ?>
</div><!-- .profile -->

<?php do_action( 'bp_after_profile_content' ) ?>