<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class('content'); ?>>

    <div class="entry-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <div class="entry-meta">
        <time class="entry-date updated" datetime="<?php get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
        <?php if ( function_exists('the_views') ) { ?>
          <span class="entry-views"><i class="fa fa-eye"></i> <?php the_views(); ?></span>
        <?php } ?>
        <?php comments_popup_link( '0', '1', '%', 'entry-comments', __('Off','r_bot') );?>
      </div>
    </div>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>

    <div class="entry-footer">
      <div class="share-buttons social-likes pull-sm-left" data-url="<?php the_permalink();?>">
        <div class="vkontakte" title="<?php _e('Share on Vkontakte','r_bot'); ?>"></div>
        <div class="facebook" title="<?php _e('Share on Facebook','r_bot'); ?>"></div>
        <div class="twitter" title="<?php _e('Share on Twitter','r_bot'); ?>"></div>
      </div>
      <div class="entry-meta pull-sm-right">
        <span class="entry-category"><?php the_category(', '); ?></span>
        <?php the_tags( '<span class="entry-tags">', ', ', '</span>' ); ?>
      </div>
    </div>
    <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'r_bot'), 'after' => '</p></nav>')); ?>
  </article>

  <?php if ( function_exists('related_posts') ) { related_posts(); } ?>

  <?php comments_template('/templates/comments.php'); ?>

<?php endwhile; ?>
