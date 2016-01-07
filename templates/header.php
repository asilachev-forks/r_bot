<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>

<body <?php body_class();?>>

  <?php do_action('get_header'); ?>

  <header class="banner" role="banner">
    <div class="mobile-header">
      <div class="logo">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand"><?php bloginfo('name');?></a>
        <p class="hidden-sm-down"><?php bloginfo('description');?></p>
      </div>
      <button type="button" class="navbar-toggle hidden-md-up" data-toggle="collapse" data-target="#navbar-collapse">
        &#9776;
      </button>
    </div>
      <div class="collapse navbar-collapse navbar-toggleable-sm" id="navbar-collapse">
    <nav class="navbar">
        <?php wp_nav_menu( array(
          'menu'              => 'primary',
          'theme_location'    => 'primary_navigation',
          'menu_class'        => 'nav navbar-nav',
          'container'       => '',
        )); ?>
    </nav>
      </div>
  </header>
