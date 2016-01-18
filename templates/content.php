<article <?php post_class(); ?>>

  <?php if ( has_post_thumbnail() ) { ?>
  <div class="entry-thumb">
    <a href="<?php the_permalink();?>"><?php the_post_thumbnail('thumbnail'); ?></a>
  </div>
  <?php } ?>

  <div class="entry-header">
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <time class="entry-date updated" datetime="<?php get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
  </div>

  <div class="entry-content">
    <?php the_content(''); ?>
  </div>

  <div class="entry-meta">
    <span class="entry-category"><?php the_category(', '); ?></span>
    <?php if ( function_exists('the_views') ) { ?>
      <span class="views"><i class="fa fa-eye"></i> <?php the_views(); ?></span>
    <?php } ?>
    <?php comments_popup_link( '0', '1', '%', 'entry-comments', __('Off','r_bot') );?>
  </div>

</article>
