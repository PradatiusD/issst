<?php
//* Start the Genesis engine

include_once( get_template_directory() . '/lib/init.php' );

//* Child theme definition (do not remove)
define( 'CHILD_THEME_NAME', 'ISSST 2016 Conference' );
define( 'CHILD_THEME_URL', 'http://github.com/PradatiusD/issst' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Add HTML5 markup structure
add_theme_support('html5', array('search-form','comment-form','comment-list'));

//* Add viewport meta tag for mobile browsers
add_theme_support('genesis-responsive-viewport');

//* Add support for custom background
add_theme_support('custom-background');

//* Add support for 3-column footer widgets
add_theme_support('genesis-footer-widgets', 3);

//* Remove Post Meta (Example Filed under: )
remove_action('genesis_entry_footer', 'genesis_post_meta');

//* Add Bootstrap powered navigation JavaScript
wp_enqueue_script('bootstrap-dropdown', get_stylesheet_directory_uri() . '/js/bootstrap-transition-collapse.js', array('jquery'), '3.3.4', true);


// Custom fonts
function custom_fonts() {
  wp_enqueue_style('custom_fonts','https://fonts.googleapis.com/css?family=Merriweather:400,400italic,700,300,300italic|Montserrat:400,700', array(), '1.0');
  wp_enqueue_style('ion_icons',   'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',  array(), '2.0.1');
}

add_action('wp_enqueue_scripts','custom_fonts');



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


//* Add button to open and close social links
function bootstrap_hamburger_icon() {
    ob_start();?>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  <?php
  echo ob_get_clean();
}
add_action( 'genesis_site_description', 'bootstrap_hamburger_icon', 10, 2 );

function add_bootstrap_mobile_classes($nav_output, $nav, $args) {
	$output = str_replace('nav-primary', 'nav-primary navbar-collapse collapse', $nav_output);
	$output = str_replace('<nav','<nav id="navbar"',$output);
	return $output;
}
add_filter( 'genesis_do_nav', 'add_bootstrap_mobile_classes', 10, 3 );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header_right',    'genesis_do_nav' );


// add_filter('genesis_seo_title', 'sp_seo_title', 10, 3);
// function sp_seo_title($title, $inside, $wrap) {
//   $inside = sprintf( '<a href="http://www.yourdomain.com" title="%s">%s</a>', esc_attr( get_bloginfo('name') ), get_bloginfo('name') );
//   $title  = sprintf('<%s id="title">%s</%s>', $wrap, $inside, $wrap);
//   return $title;
// }



remove_action('genesis_footer', 'genesis_do_footer');
add_action( 'genesis_footer', 'social_footer_links' );
function social_footer_links() {
  ?>
  <p class="text-center footer-social">
    <a href="https://twitter.com/issstnetwork" target="_blank"><i class="ion-social-twitter"></i></a>
    <a href="https://www.facebook.com/issstconference/" target="_blank"><i class="ion-social-facebook"></i></a>
    <a href="https://www.linkedin.com/grps?home=&gid=4149460" target="_blank"><i class="ion-social-linkedin"></i></a>
  </p>
  <?php
}