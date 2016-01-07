<div class="page-header">
  <?php echo title(); ?>
</div>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'r_bot'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php if (have_posts()) : ?>
  <div class="posts archive list">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', 'list'); ?>
    <?php endwhile; ?>
  </div>
  <?php the_posts_navigation(); ?>
<?php endif; ?>
