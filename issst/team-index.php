<?php
/*
	Template Name: Team Members Index
*/

	get_header();

	$args = array (
		'post_type' => 'team',
		'post_status' => 'publish',
		'nopaging'=> true
	);
	
	$temp = $wp_query; 
	$wp_query = null;
	$wp_query = new WP_Query($args); ?>

	<section class="conference-committee">
		
		<?php
		if ( $wp_query->have_posts() ):

			while ( $wp_query->have_posts() ) : $wp_query->the_post();?>

				<article>

					<h1><?php the_title();?></h1>
					<p><?php the_content();?></p>
					<?php the_post_thumbnail('medium');?>

					<?php
						$custom = get_post_custom($post->ID);
						$member_institution = $custom["member_institution"][0];
						echo "<img src='$member_institution'/>";
					?>

				</article>

		<?php
			endwhile;
		else:
			echo '<h2>No Team Members found/h2>';
		endif;
		?>
		
	</section>

	<?php
	$wp_query = $temp;
	get_footer();
	?>