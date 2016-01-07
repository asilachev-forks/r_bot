<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('content'); ?>>
    <div class="entry-header">
      <h1><?php the_title(); ?></h1>
    </div>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>
    <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'r_bot'), 'after' => '</p></nav>']); ?>
  </article>
<?php endwhile; ?>
