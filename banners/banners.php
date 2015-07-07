<?php
/*
Plugin Name: Library Banners 
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'lib_banner',
    array(
      'labels' => array(
        'name' => __( 'Banners' ),
        'singular_name' => __( 'Banner' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'banners'),
    )
  );
}
 
?>
