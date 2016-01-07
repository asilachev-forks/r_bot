<?php

/******************************************************************
 *
 *  Button Group
 *
 *******************************************************************/

add_shortcode( 'btn_group', function( $attr, $content = '' ) {

  $attr = wp_parse_args( $attr, array(
    'btn_1_anchor' => '',
    'btn_1_url' => '',
    'btn_1_color' => '',
    'btn_2_anchor' => '',
    'btn_2_url' => '',
    'btn_2_color' => '',
  ) );

  ob_start();

  ?>

  <div class="btn-group">
    <?php if( $attr['btn_1_anchor'] !== '' && $attr['btn_1_url'] !== '') { ?>
      <a href="<?php echo $attr['btn_1_url'];?>" class="btn btn-primary"><?php echo $attr['btn_1_anchor'];?></a>
    <?php } ?>
    <?php if( $attr['btn_2_anchor'] !== '' && $attr['btn_2_url'] !== '') { ?>
      <a href="<?php echo $attr['btn_2_url'];?>" class="btn btn-secondary"><?php echo $attr['btn_2_anchor'];?></a>
    <?php } ?>
  </div>

  <?php

  return ob_get_clean();

} );

/**
 * Register a UI for the Shortcode.
 * Pass the shortcode tag (string)
 * and an array or args.
 */

if ( function_exists('shortcode_ui_register_for_shortcode') ) {

  shortcode_ui_register_for_shortcode(
    'btn_group',
    array(

      // Display label. String. Required.
      'label' => __('Button Group','r_bot'),

      // Icon/attachment for shortcode. Optional. src or dashicons-$icon. Defaults to carrot.
      'listItemImage' => 'dashicons-format-aside',

      'post_type'     => array( 'post' ),

      // Available shortcode attributes and default values. Required. Array.
      // Attribute model expects 'attr', 'type' and 'label'
      // Supported field types: text, checkbox, textarea, radio, select, email, url, number, and date.
      'attrs' => array(

        array(
          'label' => __('Button 1 Anchor Text','r_bot'),
          'attr'  => 'btn_1_anchor',
          'type'  => 'text',
        ),

        array(
          'label' => __('Button 1 URL','r_bot'),
          'attr'  => 'btn_1_url',
          'type'  => 'text',
        ),

        array(
          'label' => __('Button 2 Anchor Text','r_bot'),
          'attr'  => 'btn_2_anchor',
          'type'  => 'text',
        ),

        array(
          'label' => __('Button 2 URL','r_bot'),
          'attr'  => 'btn_2_url',
          'type'  => 'text',
        ),

      ),

    )
  );
}
