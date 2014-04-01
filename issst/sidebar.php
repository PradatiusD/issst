<aside class="col-md-3">
 <?php 
 // if ( has_post_thumbnail()) {
 //   $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
 //   echo $large_image_url[0];
 // }
 ?>
	<h3 class="site-title"><a href=" <?php echo home_url();?>"><?php bloginfo('name'); ?></a></h3>
		<?php wp_nav_menu(array(
			'theme_location'  => 'sidebar-nav',
			'menu'            => '',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'nav nav-pills nav-stacked',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)); ?>
</aside>