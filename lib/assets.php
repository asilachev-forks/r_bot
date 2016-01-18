<?php

/**
 * Assets
 */

function r_bot_assets() {
  /**
   * The build task in Grunt renames production assets with a hash
   * Read the asset names from assets-manifest.json
   */

  if (WP_ENV === 'development') {
    $assets = array(
      'css'        => '/assets/css/style.css',
      'js'        => '/assets/js/scripts.js',
    );
  } else {
    $assets     = array(
      'css'        => '/style.css',
      'js'        => '/dist/js/scripts.min.js',
    );
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_enqueue_script('jquery');
  wp_enqueue_script('r_bot_js', get_template_directory_uri() . $assets['js'], array(), null, true);
  wp_enqueue_style('r_bot_css', get_template_directory_uri() . $assets['css'], false, null);



}
add_action('wp_enqueue_scripts', 'r_bot_assets', 100);

/*
 * Dequeue Plugins Scripts and Styles
 */

function r_bot_dequeue() {

  wp_dequeue_style('yarppWidgetCss');
  wp_deregister_style('yarppRelatedCss');
  wp_dequeue_style('yarppRelatedCss');

}

add_action( 'wp_enqueue_scripts', 'r_bot_dequeue' );
add_action( 'wp_head', 'r_bot_dequeue' );
add_action( 'wp_footer', 'r_bot_dequeue' );
add_action('wp_print_styles', 'r_bot_dequeue');
