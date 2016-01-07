<?php do_action('get_footer'); ?>

<footer role="contentinfo" class="content-info">
  <div class="clearfix">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="brand pull-md-left"><?php bloginfo('name');?></a>
    <span class="pull-md-right">
      <?php _e('Wordpress Theme by','r_bot'); ?> <a href="http://r0bot.ru">r0bot</a>
    </span>
  </div>
</footer>

<a href="#top" class="scroll-to-top hidden-sm-down"><i class="fa fa-angle-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
