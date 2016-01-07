<?php

/**
 * Bootstrap comment form
 */

add_filter( 'comment_form_default_fields', 'r_bot_comment_form_fields' );
function r_bot_comment_form_fields( $fields ) {
  $commenter = wp_get_current_commenter();

  $req      = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

  $fields   =  array(
    'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'default' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
    'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'default' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
    'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'default' ) . '</label> ' .
    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'
    );

  return $fields;
}

add_filter( 'comment_form_defaults', 'r_bot_comment_form' );
function r_bot_comment_form( $args ) {
  $args['comment_field'] = '<div class="form-group comment-form-comment"><textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';
  $args['class_submit'] = 'btn btn-primary-outline'; // since WP 4.1
  return $args;
}

/**
 * Custom comments markup
 */

function r_bot_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
  extract($args, EXTR_SKIP);

  if ( 'div' == $args['style'] ) {
    $tag = 'div';
    $add_below = 'comment';
  } else {
    $tag = 'li';
    $add_below = 'div-comment';
  }
?>
  <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
  <?php if ( 'div' != $args['style'] ) : ?>
  <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
  <?php endif; ?>

    <?php if ( $args['avatar_size'] != 0 && get_avatar($comment) !== '' ) { ?>
    <div class="comment-thumb">
      <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
    </div>
    <?php } ?>

    <div class="comment-content">

      <div class="comment-author-container">
        <div class="comment-author vcard"><?php echo get_comment_author_link(); ?></div>
        <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
      </div>
      <div class="comment-meta commentmetadata">
        <?php
          /* translators: 1: date, 2: time */
          printf( __('%1$s at %2$s','r_bot'), get_comment_date(),  get_comment_time() ); ?> <?php edit_comment_link( __( 'Edit', 'default' ), '  ', '' );
        ?>
      </div>

      <?php if ( $comment->comment_approved == '0' ) : ?>
      <div class="alert alert-info comment-awaiting-moderation" role="alert">
        <?php _e( 'Your comment is awaiting moderation.','r_bot' ); ?>
      </div>
      <?php endif; ?>

      <div class="comment-text">
        <?php comment_text(); ?>
      </div>

    </div>
  <?php if ( 'div' != $args['style'] ) : ?>
  </div>
  <?php endif; ?>
<?php
}

/**
 * Add class to .read-more link and wrap it in a div
 */

add_action( 'the_content_more_link', 'r_bot_add_morelink_class', 10, 2 );
function r_bot_add_morelink_class( $link, $text ) {
  $more_link = str_replace(
    'more-link',
    'more-link btn btn-primary-outline btn-sm',
    $link
  );
  return '<div class="more-wrap">'.$more_link.'</div>';
}

/*
 * Remove inline styles from Tag Clouds
 */

function r_bot_tag_cloud_widget($tags){
   return preg_replace("/style='font-size:.+pt;'/", '', $tags);
}

add_filter( 'wp_generate_tag_cloud', 'r_bot_tag_cloud_widget' );

/**
 * Page titles
 */

function title() {

  if (is_archive()) {

    if ( is_category() ) {
        return single_cat_title( '', false );
    } elseif ( is_tag() ) {
        return single_tag_title( '', false );
    } elseif ( is_author() ) {
        return get_the_author();
    } elseif ( is_year() ) {
        return get_the_date( 'Y' );
    } elseif ( is_month() ) {
        return get_the_date( 'F Y' );
    } elseif ( is_day() ) {
        return get_the_date( 'F j, Y' );
    } else {
      return get_the_archive_title();
    }

  } elseif (is_search()) {
    return get_search_query();
  } elseif (is_404()) {
    return __('Not Found', 'r_bot');
  } elseif (is_home()) {
    return __('Recent Posts', 'r_bot');
  } elseif (is_page()) {
    return get_the_title();
  }

}

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */

function r_bot_get_search_form($form) {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', 'r_bot_get_search_form');

/**
 *  Add responsive container to embeds, except for Instagram
 */

function r_bot_embed_html( $html ) {
  if (strpos($html,'instagram') == false) {
    return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
  }
  else {
    return $html;
  }
}
add_filter( 'embed_oembed_html', 'r_bot_embed_html', 10, 3 );


