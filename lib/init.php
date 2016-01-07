<?php

/**
 * Initial setup and constants
 */

function r_bot_setup() {

  // Make theme available for translation
  load_theme_textdomain('r_bot', get_template_directory() . '/lang');

  // Add post thumbnails
  add_theme_support('post-thumbnails');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Add HTML5 markup for captions
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', array('caption'));

  // Automatic Feed Links
  add_theme_support( 'automatic-feed-links' );

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('/dist/css/editor-style.min.css');

}
add_action('after_setup_theme', 'r_bot_setup');

/**
 * Register header menus
 */

function r_bot_register_header_menus() {

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus(array(
    'primary_navigation' =>   __('Primary Navigation', 'r_bot')
  ));

}
add_action('init', 'r_bot_register_header_menus');

/**
 * Register sidebars
 */

function r_bot_widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'r_bot'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<div class="widget %1$s %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="title-block">',
    'after_title'   => '</h5>'
  ]);
}
add_action('widgets_init', 'r_bot_widgets_init');
