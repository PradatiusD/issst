<?php

// Custom fonts
function custom_fonts() {
    wp_dequeue_style('custom_fonts');
    wp_enqueue_style('custom_fonts','//fonts.googleapis.com/css?family=Droid+Sans:400,700|Oswald:400,700', array(), '1.0');    
}

add_action('wp_enqueue_scripts','custom_fonts');