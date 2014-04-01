<?php
/*
Template Name: Gallery
*/
?>


<?php get_header(); ?>

<div class="container">
	<div class="row">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<div class="slider" id="hmpg-sldr">
			<ul class="slides">

				<?php if ( get_post_gallery() ) :
			            $gallery = get_post_gallery( get_the_ID(), false ); ?>
			            
			            <?php foreach( $gallery['src'] AS $src ) { ?>

			                <li class="slide" style="background-image: url('<?php echo $src; ?>');"></li>
			                
			            <?php }
			        endif; ?>
			</ul>
		</div>

<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/lib/jquery.glide.min.js"></script>
<script>
	jQuery(document).ready(function($){
		$('.slider').glide({
			arrowRightText: '&raquo;',
			arrowLeftText: '&laquo',
			autoplay: false
		});
	});
</script> 

<?php get_footer(); ?>