<?php do_action('get_footer'); ?>

<footer role="contentinfo" class="content-info">
  <div class="clearfix">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="brand pull-md-left"><?php bloginfo('name');?></a>
    <a href="#top" class="pull-md-right"><i class="fa fa-angle-up"></i> <?php _e('Top', 'r_bot'); ?></a>
  </div>
</footer>

<a href="#top" class="scroll-to-top hidden-sm-down"><i class="fa fa-angle-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
