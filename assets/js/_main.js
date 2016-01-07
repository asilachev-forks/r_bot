(function($) {

  /*
   * Mobile menu clicks
   */

  $('.navbar-nav li.menu-item > a').on('click', function(e){
    if($(window).width() < 992) {
      if ( $(this).next(".sub-menu").length > 0 ) {
        var sm = $(this).next(".sub-menu");
        if(sm.data('open') !== 1) {
          e.preventDefault();
          e.stopPropagation();
          sm.addClass('mobile-open');
          sm.data('open', 1);
          // $(this).parent().addClass('submenu-visible');
        }
      }
    }
  });

  /*
   * Sticky Sidebar
   */

  $('.sticky').stick_in_parent({
    'parent': $('.sidebar'),
    'recalc_every': 1,
    'offset_top':  30,
  });

  /*
   * Scroll To Top
   */

  $('a[href="#top"]').click(function() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    return false;
  });

})(jQuery); // Fully reference jQuery after this point.
