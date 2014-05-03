<?php global $cssPath, $jsPath, $themePath, $theLayout; ?>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><?php // Force latest IE rendering engine ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php wp_title('',1,'right'); ?></title>
<?php // Favorites and mobile bookmark icons ?>
<link rel="shortcut icon" href="<?php theme_var('options,favorites_icon','http://para.llel.us/favicon.ico'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php theme_var('options,apple_touch_icon','http://para.llel.us/apple-touch-icon.png'); ?>">

<?php // JS variables needed to trigger theme functionality ?>
<script type="text/javascript"> 
	var fadeContent = '<?php theme_var('options,fade_in_content','none'); ?>'; 
	var toolTips = '<?php theme_var('options,tool_tips','none'); ?>'; 
</script>

<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Homemade+Apple' rel='stylesheet' type='text/css'>

<meta property="og:image" content="http://24merrydays.com/images/24-merry-days-2013-fb.jpg"/> 
<meta name="description" content="The Bloggerhood" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php 
// WordPress headers.
// This includes all theme CSS and some JS files. You can add or modify the list from "functions.php" 
do_action( 'bp_head' );
wp_head();

// Feed link / Pingback link ?>



<!--[if lte IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>ie.css" />
<![endif]-->


<div id="blue-top">
	<div id="blue-top-container"> 
	
	<?php 
		global $userdata,$user_identity, $user_login;
		get_currentuserinfo();
		
		if(is_user_logged_in()){
			echo '<p class="hello">Hello <a href="'. bp_loggedin_user_domain( '/' ) .'" class="hello">' . $user_identity . '</a>!</p>'; 
			echo '<p class="logout"><a href="'. wp_logout_url() .'">Logout</a></p>'; 
		}else{
			echo '<p class="sign-in"> Sign In </p>'; 
			echo '<p class="reg"><a href="'. site_url() .'/register">Register</a></p>'; 
		}
	?>

	<div id="sign-in-box">
		<form name="login-form" id="sidebar-login-form" class="standard-form" action="<?php echo site_url( 'wp-login.php', 'login_post' ) ?>" method="post">
			<label><span><?php _e( 'Username', 'buddypress' ) ?></span>
			<input type="text" name="log" id="sidebar-user-login" class="input" placeholder="Username" value="<?php if ( isset( $user_login) ) echo esc_attr(stripslashes($user_login)); ?>" tabindex="97" /></label>

			<label><span><?php _e( 'Password', 'buddypress' ) ?></span>
			<input type="password" name="pwd" id="sidebar-user-pass" placeholder="Password" class="input" value="" tabindex="98" /></label>

			<?php do_action( 'bp_sidebar_login_form' ) ?>
			<input type="submit" name="wp-submit" id="sidebar-wp-submit" value="<?php _e( 'Log In', 'buddypress' ); ?>" tabindex="100" />
			<p class="forgetmenot"><label><input name="rememberme" type="checkbox" id="sidebar-rememberme" value="forever" tabindex="99" /> <?php _e( 'Remember Me', 'buddypress' ) ?></label></p>
		</form>
		<div class="clear-me"></div>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {
  		
		$.fn.slideFadeToggle  = function(speed, easing, callback) {
        	return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
		};

		$("p.sign-in").click(function() {
			$( "#sign-in-box" ).slideFadeToggle();
		});
		
	});
	</script>

	</div>
</div>
