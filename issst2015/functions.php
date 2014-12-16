<?php

// Custom fonts
function custom_fonts() {
    wp_dequeue_style('custom_fonts');
    wp_enqueue_style('custom_fonts','//fonts.googleapis.com/css?family=Roboto:400,500,400italic,700,300|Roboto+Condensed:400,700', array(), '1.0');    
}

add_action('wp_enqueue_scripts','custom_fonts');

// Homepage script
function homepage_scripts() {
    wp_enqueue_script('twitter_and_homepage_js', get_stylesheet_directory_uri()."/js/homepage.min.js", array('jquery'), '1.0.0', true);
}
add_action( 'wp_enqueue_scripts', 'homepage_scripts');


// Google webmaster tools
function add_google_webmaster_tools(){
    ob_start();
    ?>
    <meta name="google-site-verification" content="k8zbotjikXd1m6e1-bjkuMudhoDTRq3vOMzm5oodcC8" />
    <?php
    $output = ob_get_clean();
    echo $output;
}
add_action('wp_head','add_google_webmaster_tools');

// Remove Date and add Title/Logo columns
function add_team_columns($columns) {
    unset($columns['date']);
    return array_merge($columns, 
              array('org_title'  => 'Role',
                    'member_img' => 'Member Photo',
                    'logo'       =>'Institution Logo'
                )
          );
}
add_filter('manage_2015-team_posts_columns' , 'add_team_columns');


// Now add the data to the rows 
function custom_columns( $column, $post_id ) {

    $meta = get_post_meta($post_id);

    switch ( $column ) {

        case 'org_title':
            echo $meta['wpcf-org-title'][0];
            break;

        case 'member_img':
            echo get_the_post_thumbnail($post_id, 'thumbnail');
            break;

        case 'logo':
            echo "<img src='".$meta['wpcf-institution-logo'][0]."' class='inst-logo'>";
            break;
    }
}
add_action( 'manage_posts_custom_column' , 'custom_columns', 10, 2 );


// Now add backend styles
function team_backend_styles() {
    ob_start();
?>
    <style>
        tr.type-2015-team .check-column input {
            margin-bottom: 2.3em;            
        }

        img.inst-logo {
            max-width: 100%;
            max-height: 150px
        }

        tr.type-2015-team .check-column,
        tr.type-2015-team td.column-title,
        td.logo.column-logo, 
        td.org_title.column-org_title {
            vertical-align: middle;
        }
    </style>

<?php
  $content = ob_get_clean();
  echo $content;
}
add_action('admin_head', 'team_backend_styles');

// Require twitter script
require_once('twitter.php');