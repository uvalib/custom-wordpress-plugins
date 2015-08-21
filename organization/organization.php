<?php
/*
Plugin Name: Library Organizations
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Register organization post type
add_action( 'init', 'create_organization_post_type' );
function create_organization_post_type() {
        register_post_type( 'uvalib_organization',
                array(
                        'labels' => array(
                                'name' => __( 'Organizations' ),
                                'singular_name' => __( 'Organization' )
                        ),
                        'description' => 'Departments, divisions, and other organizational units at the U.Va. Library',
                        'public' => true,
                        'capability_type' => 'post',
                        'supports' => array(
                              'title',
                              'editor',
                              'revisions',
                              'page-attributes'
                        ),
                        'register_meta_box_cb' => 'add_organization_metaboxes',
                        'taxonomies' => array(
                              'post_tag'
                        ),
                        'hierarchical' => true,
                        'rewrite' => array('slug' => 'organization'),
                        'can_export' => true
                 )
        );
        wp_register_style( 'custom-style', plugins_url( '/organization.css', __FILE__ ), array(), '20150821', 'all' );
}

// Attach custom field meta box to organization post type
function add_organization_metaboxes() {
  add_meta_box(
    'uvalib_organization_additional_info',
    'Additional Information',
    'uvalib_organization_additional_info',
    'uvalib_organization',
    'normal',
    'high'
  );
}

// Display custom fields in meta box
function uvalib_organization_additional_info() {
  global $post;

  uvalib_nonce($post->post_type);

  $field_names = uvalib_get_custom_keys_by_type( $post->post_type );
  $fields = uvalib_get_meta( $post->ID, $field_names );

  // Print out the fields
    echo '<h4>Contact Name</h4>';
  echo '<input type="text" name="_contact_name" value="' . $fields['_contact_name']  . '" class="widefat" />';

    echo '<h4>Contact Phone Number</h4>';
  echo '<input type="text" name="_phone_number" value="' . $fields['_phone_number']  . '" class="widefat" />';

  echo '<h4>Contact Fax Number</h4>';
  echo '<input type="text" name="_fax_number" value="' . $fields['_fax_number']  . '" class="widefat" />';

  echo '<h4>Contact Email Address</h4>';
  echo '<input type="text" name="_email_address" value="' . $fields['_email_address']  . '" class="widefat" />';

  echo '<h4>Twitter User Name</h4>';
  echo '<p>A Twitter handle associated with this group. <strong>Please leave off the @.</strong></p>';
  echo '<input type="text" name="_twitter_handle" value="' . $fields['_twitter_handle'] . '" class="widefat" />';

  echo '<h4>Facebook Page URL</h4>';
  echo '<p>The URL for a related Facebook page, if applicable. <strong>Be sure to include http://</strong></p>';
  echo '<input type="text" name="_facebook_url" value="' . $fields['_facebook_url'] . '" class="widefat" />';

  echo '<h4>Flickr User Name</h4>';
  echo '<p>A Flickr account name associated with this group.</p>';
  echo '<input type="text" name="_flickr_username" value="' . $fields['_flickr_username'] . '" class="widefat" />';

  echo '<h4>Blog Feed URL</h4>';
  echo '<p>The RSS or Atom feed URL for the library\'s blog. <strong>Be sure to include http://</strong></p>';
  echo '<input type="text" name="_feed_url" value="' . $fields['_feed_url'] . '" class="widefat" />';

  echo '<h4>Department MyGroups ID</h4>';
  echo '<input type="text" name="_my_groups_id" value="' . $fields['_my_groups_id']  . '" class="widefat" />';
}

// Save custom fields
add_action( 'save_post', 'uvalib_save_meta', 1, 2 );
 
?>
