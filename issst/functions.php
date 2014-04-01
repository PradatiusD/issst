<?php

	register_nav_menu( 'sidebar-nav', 'Sidebar navigation' );


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