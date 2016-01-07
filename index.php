<div class="page-header">
  <h1><?php echo title(); ?></h1>
</div>

<?php if (!have_posts()) { ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'r_bot'); ?>
  </div>
  <?php get_search_form(); ?>
<?php } ?>

<?php if (have_posts()) { ?>
  <div class="posts">
    <?php while (have_posts()) { the_post(); ?>
      <?php get_template_part('templates/content'); ?>
    <?php } ?>
    <?php the_posts_pagination( array(
      'mid_size'  => 2,
      'prev_text' => __( 'Previous', 'r_bot' ),
      'next_text' => __( 'Next', 'r_bot' ),
    ) ); ?>
  </div>
<?php } ?>
