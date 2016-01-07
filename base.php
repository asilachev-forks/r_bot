<?php get_template_part('templates/header'); ?>

<div class="wrap" role="document">
  <div class="page-content">
    <main class="main" role="main">
      <?php include r_bot_template_path(); ?>
    </main>
    <aside class="sidebar" role="complementary">
      <?php include r_bot_sidebar_path(); ?>
    </aside>
  </div>
</div>

<?php get_template_part('templates/footer'); ?>
