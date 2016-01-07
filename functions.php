<?php

/**
 * Include theme specific functions
 *
 * The $r_bot_includes array determines the theme specific code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

$r_bot_includes = array(

  'lib/init.php',                             // Initial theme setup and constants
  'lib/functions.php',                        // Functions
  'lib/assets.php',                           // Theme specific assets
  'lib/wrapper.php',                          // Theme wrapper and sidebar class
  'lib/shortcodes.php',                       // Shortcodes

);

foreach ($r_bot_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'r_bot'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);
