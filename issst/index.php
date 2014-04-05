<?php get_header(); ?>

	<div class="container">
		<div class="row">

			<main class="col-md-12">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>

						<?php the_content('Read more...'); ?>

				<?php endwhile; else: ?>
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
		
				<div class="commentlist">
					<?php comments_template( '/comments.php' ) ?>
				</div>

			</main>
		</div>
	</div>

<?php get_footer(); ?>