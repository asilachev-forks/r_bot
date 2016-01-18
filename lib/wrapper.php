<?php
/**
 * Theme wrapper
 *
 */
function r_bot_template_path() {
  return R_BOT_Wrapping::$main_template;
}

function r_bot_sidebar_path() {
  return new R_BOT_Wrapping('templates/sidebar.php');
}

class R_BOT_Wrapping {
  // Stores the full path to the main template file
  static $main_template;

  // Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
  static $base;

  public function __construct($template = 'base.php') {
    $this->slug = basename($template, '.php');
    $this->templates = array($template);

    if (self::$base) {
      $str = substr($template, 0, -4);
      array_unshift($this->templates, sprintf($str . '-%s.php', self::$base));
    }
  }

  public function __toString() {
    $this->templates = apply_filters('r_bot/wrap_' . $this->slug, $this->templates);
    return locate_template($this->templates);
  }

  static function wrap($main) {
    self::$main_template = $main;
    self::$base = basename(self::$main_template, '.php');

    if (self::$base === 'index') {
      self::$base = false;
    }

    return new R_BOT_Wrapping();
  }
}
add_filter('template_include', array('R_BOT_Wrapping', 'wrap'), 99);


/**
 * Determines whether or not to display the sidebar based on an array of conditional tags or page templates.
 *
 * If any of the is_* conditional tags or is_page_template(template_file) checks return true, the sidebar will NOT be displayed.
 *
 * @param array list of conditional tags (http://codex.wordpress.org/Conditional_Tags)
 * @param array list of page templates. These will be checked via is_page_template()
 *
 * @return boolean True will display the sidebar, False will not
 */

class R_BOT_Sidebar {
  private $conditionals;
  private $templates;

  public $display = true;

  function __construct($conditionals = array(), $templates = array()) {
    $this->conditionals = $conditionals;
    $this->templates    = $templates;

    $conditionals = array_map(array($this, 'check_conditional_tag'), $this->conditionals);
    $templates    = array_map(array($this, 'check_page_template'), $this->templates);

    if (in_array(true, $conditionals) || in_array(true, $templates)) {
      $this->display = false;
    }
  }

  private function check_conditional_tag($conditional_tag) {
    $conditional_arg = is_array($conditional_tag) ? $conditional_tag[1] : false;
    $conditional_tag = $conditional_arg ? $conditional_tag[0] : $conditional_tag;

    if (function_exists($conditional_tag)) {
      return $conditional_arg ? $conditional_tag($conditional_arg) : $conditional_tag();
    } else {
      return false;
    }
  }

  private function check_page_template($page_template) {
    return is_page_template($page_template);
  }
}

/**
 * Add body class if sidebar is active
 */

function r_bot_sidebar_body_class($classes) {
  if (r_bot_display_sidebar() && get_theme_mod('r_bot_sidebar','right') !== 'none') {
    $classes[] = 'sidebar-primary';
  }
  elseif (!r_bot_display_sidebar()) {
    $classes[] = 'full-width';
  }
  return $classes;
}
add_filter('body_class', 'r_bot_sidebar_body_class');

/**
 * Define which pages shouldn't have the sidebar
 */

function r_bot_display_sidebar() {
  $sidebar_config = new R_BOT_Sidebar(
    /**
     * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
     * Any of these conditional tags that return true won't show the sidebar
     *
     * To use a function that accepts arguments, use the following format:
     *
     * array('function_name', array('arg1', 'arg2'))
     *
     * The second element must be an array even if there's only 1 argument.
     */
    array(
      array( 'is_singular', array('project') ),
    ),
    /**
     * Page template checks (via is_page_template())
     * Any of these page templates that return true won't show the sidebar
     */
    array(
      'template-fullwidth.php'
    )
  );

  return apply_filters('r_bot/display_sidebar', $sidebar_config->display);
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */

if (!isset($content_width)) { $content_width = 1140; }
