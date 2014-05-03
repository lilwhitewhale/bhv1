<?php
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
	  show_admin_bar(false);
	}
}



function restrict_access(){
	global $bp, $bp_unfiltered_uri;

	if (!is_user_logged_in() && (
	BP_MEMBERS_SLUG == $bp_unfiltered_uri[0] ||
	BP_GROUPS_SLUG == $bp->current_component ||
	BP_BLOGS_SLUG == $bp->current_component ||
	'forums' == $bp->current_component ||
	is_page_template('website here')
	)){
	
		bp_core_redirect( get_option('home') . "/register" );
	
	}
}

add_action( 'wp', 'restrict_access', 3 );



function mycustom_breadcrumb_options() {
	// Home - default = true
	$args['include_home']    = false;
	// Forum root - default = true
	$args['include_root']    = false;
	// Current - default = true
	$args['include_current'] = true;

	return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'mycustom_breadcrumb_options' );



if( !function_exists('add_member_custom_extended_profile') ):

function add_member_custom_extended_profile() {
		$data_name = bp_get_member_profile_data( 'field=First Name' );
		$data_city = bp_get_member_profile_data( 'field=City' );
		$data_blogurl = bp_get_member_profile_data( 'field=I blog at' );
		$data_blogname = bp_get_member_profile_data( 'field=Blog name' );
		$data_blogabout = bp_get_member_profile_data( 'field=I blog about' );
		
		echo '<div class="item-meta"><span class="profile-extend-meta">';
		
		if(($data_blogurl) && ($data_blogname)) echo '<h4> <a href="' . $data_blogurl . '" target="_blank">' . $data_blogname . '</a></h4>';
		if($data_name) echo '<p><span class="name">' . $data_name . '</span> <span class="from">from</span> <span class="city">' . $data_city . '</span></p>';
		if($data_blogabout) echo '<p class="blog-topics">' . $data_blogabout . '</p>';
		
		
		echo '</span></div>';
		}
	
	add_action('bp_directory_members_item',  'add_member_custom_extended_profile');

endif;




/*add_action( 'init', 'my_add_shortcodes' );

function my_add_shortcodes() {

	add_shortcode( 'my-login-form', 'my_login_form_shortcode' );
}

function my_login_form_shortcode() {

	if ( is_user_logged_in() )
		return '';

	return wp_login_form( array( 'echo' => false ) );
}*/


// Filter wp_nav_menu() to add profile link
/*add_filter( 'wp_nav_menu_items', 'my_nav_menu_profile_link' );
function my_nav_menu_profile_link($menu) { 	
	if (!is_user_logged_in())
		return $menu;
	else
		$profilelink = '<li><a href="' . bp_loggedin_user_domain( '/' ) . '">' . __('My Profile') . '</a></li>';
		$menu = $menu . $profilelink;
		return $menu;
}*/

?>