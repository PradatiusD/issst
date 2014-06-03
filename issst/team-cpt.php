<?php

	add_action('admin_head', 'team_admin_styles');

	function team_admin_styles() {
		ob_start();
	?>
		<style>

			td.mem_inst,
			tr.type-team td,
			tr.type-team .check-column {
				vertical-align: middle;
			}

			tr.type-team .check-column input {
				margin-bottom: 2.4em;
			}

		</style>

	<?php
	  $content = ob_get_clean();
	  echo $content;
	}

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

	add_action('save_post', 'team_save_details');

	function team_save_details(){
		global $post;
		update_post_meta($post->ID, "member_institution", $_POST["member_institution"]);
	}

	function team_cpt_columns($columns) {

		unset($columns['date']);

		$new_columns = array(
			// Slug => DisplayText
			'role' => 'Role',
			'feat_img' => 'Member Photo',
			'mem_inst' => 'Institution Logo'
		);
		return array_merge($columns, $new_columns);
	}
	add_filter('manage_team_posts_columns' , 'team_cpt_columns');


	add_action( 'manage_posts_custom_column' , 'custom_team_columns', 10, 2 );

	function custom_team_columns( $column, $post_id ) {

		switch ( $column ) {

			case 'role' :

				echo get_post_field('post_content', $post_id);
				break;

			case 'feat_img' :

				echo get_the_post_thumbnail($post_id, 'thumbnail');
				break;

			case 'mem_inst' :

				$custom = get_post_custom($post_id);
				$member_institution = $custom["member_institution"][0];
				echo "<img src='$member_institution' style='max-width:150px;height:auto'/>";
				break;
		}
	}