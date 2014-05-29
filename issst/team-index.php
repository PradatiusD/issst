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
	$wp_query = new WP_Query($args);

	$j = 0;
?>
	<div class="container">
		<div class="col-md-12">
			<section class="conference-committee" id="container">
				
				<?php
				if ( $wp_query->have_posts() ):

					while ( $wp_query->have_posts() ) : $wp_query->the_post();?>

						<article class="item item-<?php echo $j;?>">

							<h1><?php the_title();?></h1>
							<p><?php the_content();?></p>
							<?php the_post_thumbnail('medium');?>

						</article>

						<aside class="item item-<?php echo $j;?>">
							<?php
								$custom = get_post_custom($post->ID);
								$member_institution = $custom["member_institution"][0];
								echo "<img src='$member_institution'/>";
							?>
						</aside>

				<?php
					$j++;
					endwhile;
				else:
					echo '<h2>No Team Members found/h2>';
				endif;
				?>
				
			</section>
		</div>
	</div>
<script>
	(function($){

		var $container = $('#container');
		$container.find('.item').hover(
			function(){
				var classes = $(this).attr('class');
				var number = parseInt(classes.match(/[0-999]/g).join(''));
				$container.find('.item-'+number).find('img').toggleClass('hovered');
			},
			function(){
				$container.find('img').removeClass('hovered');
			}
		);

	})(jQuery);
</script>
<?php
	$wp_query = $temp;
	get_footer();
?>
