<?php
/*
Plugin Name: Filter Inline Stuff
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

add_filter( 'wp_insert_post_data' , 'filter_post_data' , '99', 2 );

function filter_post_data( $data , $postarr ) {

    $content = $data['post_content'];
    $content = strip_html($content);
    $data['post_content'] = $content;
    return $data;
}

function strip_html($text, $allowed_tags = '<img><table><td><tr><th><div><a><ul><ol><li><b><i><sup><sub><em><strong><u><br><br/><br /><p><h2><h3><h4><h5><h6>')
{
    mb_regex_encoding('UTF-8');
    $text = strip_tags($text, $allowed_tags);
    //strip out inline css and simplify style tags
    $text = preg_replace('/(<[^>]+) style=\\\\".*?\\\\"/i', '$1', $text);
    $text = preg_replace("/(<[^>]+) style=\\\\'.*?\\\\'/i", '$1', $text);
    $text = preg_replace("/(<[^>]+) style=.*?>/i", '$1>', $text);
    return $text;
}
?>
