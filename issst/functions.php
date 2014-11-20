<?php

	if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {

		// For Debugging on Localhost
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		// For live reloading
		function local_livereload(){
			wp_register_script('livereload', 'http://localhost:35729/livereload.js', null, false, true);
			wp_enqueue_script('livereload');    
		}

		add_action( 'wp_enqueue_scripts', 'local_livereload');
	}

	add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

	function special_nav_class($classes, $item){
		 if (in_array('current-menu-item', $classes) ){
				 $classes[] = 'active ';
		 }
		 return $classes;
	}



	// Header Scripts
	function header_scripts () {
		wp_enqueue_script('jquery');
		wp_enqueue_style('theme-style', get_stylesheet_uri());
		wp_enqueue_style('custom_fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic', array(), '1.0');
		wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', array(), '4.0.3');
	}

	add_action('wp_enqueue_scripts','header_scripts');

	// Footer Scripts
	function footer_scripts() {
		wp_enqueue_script('issstNetworkJS', get_template_directory_uri() . '/js/global.min.js', array('jquery'), '1.0.0', true);
	}

	add_action( 'wp_enqueue_scripts', 'footer_scripts');

	


	add_theme_support('post-thumbnails');

	// Register Custom Navigation Walker
	require_once('wp_bootstrap_navwalker.php');

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'ISSST' ),
	) );

	register_sidebar(array(
		'name'=> 'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<article id="%1$s" class="widget %2$s">',
		'after_widget'  => '</article>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	));


	function excerpt_read_more( $more ) {
		return '...'.
				'<div class="row text-right">'.
					'<div class="col-md-12">'.
						'<a class="btn btn-info" href="'. get_permalink( get_the_ID() ) . '">'
							. __('Read More', 'your-text-domain') .
						'</a>' .
					'</div>'.
				'</div>';
	}
	add_filter( 'excerpt_more', 'excerpt_read_more' );


	function issst_login_logo() { ?>
	    <style type="text/css">

	        @import url("http://fonts.googleapis.com/css?family=Roboto:400,500");

			body {
			    font-family: 'Roboto' !important;
			}

	        body.login div#login h1 a {
	            background-image: url(<?php echo get_template_directory_uri(); ?>/img/issst-login-logo.png);
				padding-bottom: 23px;
				background-size: 100% auto;
				width: 100%;
	        }

			input#wp-submit {
			    background: #26adee;
			    border: 1px solid #1A85B8;
			}

	    </style>
	<?php }
	add_action( 'login_enqueue_scripts', 'issst_login_logo' );