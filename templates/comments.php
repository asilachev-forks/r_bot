<?php
if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments">
  <?php if (have_comments()) : ?>
    <h5 class="title-block"><?php _e('Comments','r_bot'); ?> <span class="uppercase">(<?php echo get_comments_number();?>)</span></h5>

    <ol class="comment-list">
      <?php wp_list_comments(['style' => 'ol', 'short_ping' => true, 'avatar_size' => 32, 'callback' => 'r_bot_comments']); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav>
        <ul class="pager">
          <?php if (get_previous_comments_link()) : ?>
            <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'r_bot')); ?></li>
          <?php endif; ?>
          <?php if (get_next_comments_link()) : ?>
            <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'r_bot')); ?></li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  <?php endif; // have_comments() ?>

  <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
    <div class="alert alert-warning">
      <?php _e('Comments are closed.', 'r_bot'); ?>
    </div>
  <?php endif; ?>

  <?php comment_form(array(
      'comment_notes_after' => '',
      'comment_notes_before'  => '',
      'title_reply'     => __('Leave a reply', 'r_bot'),
      'title_reply_to' => __('Leave a reply', 'r_bot'),
      'cancel_reply_link'   => __('Cancel', 'r_bot'),
      'label_submit'      => __('Post Comment', 'r_bot')
    )); ?>

</section>
