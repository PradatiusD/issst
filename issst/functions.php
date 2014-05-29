<?php

	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
	function special_nav_class($classes, $item){
		 if( in_array('current-menu-item', $classes) ){
				 $classes[] = 'active ';
		 }
		 return $classes;
	}

	add_action( 'wp_enqueue_script', 'load_jquery' );
	function load_jquery() {
		wp_enqueue_script( 'jquery' );
	}

	add_theme_support('post-thumbnails');

	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ISSST' ),
	) );

	register_sidebar(array(
		'name'=> 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget' => '</article>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));


	function excerpt_read_more( $more ) {
		return '...'.
				'<div class="row text-right">'.
					'<div class="col-md-12">'.
						'<a class="btn btn-info" href="'. get_permalink( get_the_ID() ) . '">'
							. __('Read More', 'your-text-domain') .
						'</a>' .
					'</div>'.
				'</div>';
	}
	add_filter( 'excerpt_more', 'excerpt_read_more' );


	add_action('init', 'team_register');
	 
	function team_register() {
	 
		$labels = array(
			'name' => 			'ISSST 2014 Team',
			'singular_name' => 	'Team Member',
			'add_new' => 		'Add New',
			'add_new_item' => 	'Add New Team Member',
			'edit_item' => 		'Edit Team Member',
			'new_item' => 		'New Team Member',
			'view_item' => 		'View Team Member',
			'search_items' => 	'Search Team Members',
			'not_found' =>  	'Nothing found',
			'not_found_in_trash' => 'Nothing found in Trash',
			'parent_item_colon' => ''
		);
	 
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			// 'menu_icon' => get_stylesheet_directory_uri() . '/.png',
			'rewrite' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array('title','editor','thumbnail')
		  ); 
	 
		register_post_type( 'team' , $args );
		flush_rewrite_rules();
	}

	add_action("admin_init", "admin_init");

	function admin_init(){
		add_meta_box("member_institution-meta", "Institution", "member_institution", "team", "normal", "low");
	}

	function member_institution(){

		global $post;
		$custom = get_post_custom($post->ID);
		$member_institution = $custom["member_institution"][0];
		?>

		<label>
			Institution Image:<br/>
			Enter an URL or upload an image for the person's institution.
		</label>

		<tr valign="top">
			<td>
				<img src="<?php echo $member_institution; ?>" alt="" style="display:block;">
				<label for="upload_image">
					<input name="member_institution" id="member_institution" value="<?php echo $member_institution; ?>" />
					<input id="member_institution_btn" type="button" value="Upload Image" class="button" />
				</label>
			</td>
		</tr>
		
		<script>
			jQuery('#member_institution_btn').click(function() {
				tb_show('', 'media-upload.php?TB_iframe=true');
				
				window.send_to_editor = function(html) {
					url = jQuery(html).attr('href');
					jQuery('#member_institution').val(url);
					tb_remove();
				};
				return false;
			});
		</script>
		
			<?php
	}

	add_action('save_post', 'save_details');

	function save_details(){
		global $post;
		update_post_meta($post->ID, "member_institution", $_POST["member_institution"]);
	}