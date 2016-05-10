<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php wp_title(get_bloginfo('name') .' |',true,'left');?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="<?php bloginfo('charset'); ?>">
		<link rel="icon" href="<?php echo get_stylesheet_directory_uri();?>/favicon.ico" type="image/x-icon" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<?php wp_head(); ?>
	</head>
	<body ng-app="issstApp" <?php body_class(); ?>>
	<div class="page-wrap">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		  <div class="container-fluid">

			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="navbar-brand" href="<?php echo home_url(); ?>">
						<?php bloginfo('name'); ?>
					</a>
			</div>

				<?php
					wp_nav_menu( array(
						'menu'              => 'primary',
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'div',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'main-nav-collapse',
						'menu_class'        => 'nav navbar-nav',
						'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						'walker'            => new wp_bootstrap_navwalker())
					);
				?>
			</div>
		</nav>