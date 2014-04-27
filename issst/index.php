<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<main class="col-md-9">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

						<ol class="breadcrumb">
							<li>Filed under:</li>
							<?php

								$categories = get_the_category(); 

								foreach ($categories as $cat):
									if ($cat->name !== 'Uncategorized'):

							?>		
								<li>
									<a href="<?php echo get_category_link($cat->cat_ID);?>">
									<?php echo $cat->name;?>
									</a>
								</li>

							<?php
									endif;
								endforeach;?>
						</ol>

						<?php
							if (is_home() || is_category()) {
								the_excerpt();
							} else {
								the_content('Read more...');
							}
						?>

				<?php endwhile;?>
						<hr>
						<div class="text-center">
							<nav class="btn-group blog-pagination">				
								<?php previous_posts_link( 'Newer posts' ); ?>
								<?php next_posts_link( 'Older posts' ); ?>
							</nav>
						</div>
				<?php else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

			</main>

			<aside class="col-md-3">
				<?php get_sidebar(); ?>
			</aside>

		</div>

	</div>

		<div class="row">
			<section class="col-md-12 commentlist">
				<?php comments_template( '/comments.php' ) ?>
			</section>
		</div>

	<script>
		(function($){
			
			(function removeBreadcrumbsIfNoCategories(){
				$('.breadcrumb').each(function(){

					if($(this).find('li').length === 1) {
						$(this).remove();
					}
				});

			})();

			(function fixPaginationBlog(){
				$('.blog-pagination a').addClass('btn btn-primary');
			})();

		})(jQuery);
	</script>

<?php get_footer(); ?>