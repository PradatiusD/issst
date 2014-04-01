<?php get_header(); ?>

	<div class="sidebar-bg"></div>

	<div class="container">
		<div class="row">

			<?php get_sidebar(); ?>

			<main class="col-md-9">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

						<?php the_content('Read more...'); ?>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
				
			</main>
		</div>
	</div>

<?php get_footer(); ?>