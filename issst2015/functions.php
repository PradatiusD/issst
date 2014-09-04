<?php

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