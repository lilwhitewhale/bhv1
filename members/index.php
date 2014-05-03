
	<div id="content">
		<div class="padder">

		<link href="http://thebloggerhood.com/wp-content/themes/bloggerhood/map/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
		<script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
		<script src="http://thebloggerhood.com/wp-content/themes/bloggerhood/map/jqvmap/jquery.vmap.js" type="text/javascript"></script>
		<script src="http://thebloggerhood.com/wp-content/themes/bloggerhood/map/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    
		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('#vmap').vectorMap({
				    map: 'usa_en',
					backgroundColor: '#FFFFFF',
					color: '#ffd4cd',
				    borderColor: '#FFFFFF',
				    borderOpacity: 1,
			    	borderWidth: 1.5,
					hoverColor: '#ffc406',
					selectedColor: '#ffc406',
				    enableZoom: false,
				    showTooltip: true,
				    selectedRegion: 'MO',
					onRegionClick: function(element, code, region){    
				        hello(region);
				    }
				});
				
				$("#members-list li:odd").addClass("odd");
			});
			
			function hello(state){
				//var state_title = "<h3 class='stitle'>" + state + "</h3>";
				//$("#state_blogs").html(state_title);
				var state_url = "http://thebloggerhood.com/members/?s=" + state + "#state_list";
				
				location.href = state_url;
			}
			
		</script>

		<!-- map -->
		<div id="vmap" style="max-width: 910px; height: 600px;margin:0 auto;"> 
			<p id="map-directions">Click on your state to find local blogger friends today!</p>
		</div>
		
		<!-- blogs by state -->
		<div id="state_blogs"> </div>

		
		
		
		

		<header class="entry-header" id="state_list">
			
			<div class="item-list-tabs no-ajax" id="subnav">
					<ul>
						<li id="members-order-select" class="last filter">
	
							<?php _e( 'Order By:', 'buddypress' ) ?>
							<select>
								<option value="active"><?php _e( 'Last Active', 'buddypress' ) ?></option>
								<option value="newest"><?php _e( 'Newest Registered', 'buddypress' ) ?></option>
	
								<?php if ( bp_is_active( 'xprofile' ) ) : ?>
									<option value="alphabetical"><?php _e( 'Alphabetical', 'buddypress' ) ?></option>
								<?php endif; ?>
	
								<?php do_action( 'bp_members_directory_order_options' ) ?>
							</select>
						</li>
					</ul>
				</div><!-- .item-list-tabs -->
				
			<div id="members-dir-search" class="dir-search">
				<?php bp_directory_members_search_form() ?>
			</div><!-- #members-dir-search -->	

			<div class="clear-me"></div>
		</header>
				
			<form action="" method="post" id="members-directory-form" class="dir-form">
				
				
				
				<div class="item-list-tabs bp-content-tabs">
					<ul>
						<li class="selected" id="members-all"><?php printf( __( '', 'buddypress' ), bp_get_total_member_count() ) ?></li>
	
						<?php if ( is_user_logged_in() && function_exists( 'bp_get_total_friend_count' ) && bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>
							<li id="members-personal"><a href="<?php echo bp_loggedin_user_domain() . BP_FRIENDS_SLUG . '/my-friends/' ?>"><?php printf( __( 'My Friends <span>%s</span>', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ) ?></a></li>
						<?php endif; ?>
	
						<?php do_action( 'bp_members_directory_member_types' ) ?>
	
					</ul>
				</div><!-- .item-list-tabs -->
				

				<div id="members-dir-list" class="members dir-list">
					<?php locate_template( array( 'members/members-loop.php' ), true ) ?>
				</div><!-- #members-dir-list -->
	
				<?php do_action( 'bp_directory_members_content' ) ?>
	
				<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ) ?>
	
				<?php do_action( 'bp_after_directory_members_content' ) ?>
	
			</form><!-- #members-directory-form -->

			
			
		</div><!-- .padder -->
	</div><!-- #content -->