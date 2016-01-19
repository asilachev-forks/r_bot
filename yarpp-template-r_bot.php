<?php
/*
YARPP Template: r_bot
Author: r0bot
Description: r_bot YARPP template
*/
?>
<?php if (have_posts()) { ?>
<div class="related-posts">
  <h4 class="title-block"><?php _e('Related posts','r_bot');?></h4>
  <ol>
  	<?php while (have_posts()) { the_post(); ?>
  	<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
  	<?php } ?>
  </ol>
</div>
<?php } ?>
