<form role="search" method="get" class="search-form form" action="<?php esc_url(home_url('/')); ?>">
  <label class="sr-only"><?php _e('Search for:', 'r_bot'); ?></label>
  <div class="input-group">
    <input type="search" value="<?php get_search_query(); ?>" name="s" class="search-field form-control" placeholder="<?php _e('Search', 'r_bot'); ?> <?php bloginfo('name'); ?>" required>
    <span class="input-group-btn">
      <button type="submit" class="search-submit btn btn-primary-outline"><?php _e('Search', 'r_bot'); ?></button>
    </span>
  </div>
</form>
