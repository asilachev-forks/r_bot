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
  <?php $total = $wp_query->post_count; ?>

  <div class="posts">

    <?php while (have_posts()) {
      the_post();
      $current = $wp_query->current_post + 1;
      if ($current == 1) {
        echo '<div class="row">';
      }
      echo '<div class="col-sm-6">';
      get_template_part('templates/content');
      echo '</div>';
      if (($current % 2 == 0) && ($current !== $total)) {
        echo ("</div><div class='row'>");
      }
      if ($current == $total) {
        echo '</div>';
      }
    } ?>

    <?php the_posts_pagination( array(
      'mid_size'  => 2,
      'prev_text' => __( 'Previous', 'r_bot' ),
      'next_text' => __( 'Next', 'r_bot' ),
    ) ); ?>
  </div>

<?php } ?>
