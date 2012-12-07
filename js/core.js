(function($){
  $('#navigation').bind('navfit', function(){
    var nav = $(this),
      items = nav.find('a');

    // remove the class in case it is present (e.g. from an orientation change event)
    $('body').removeClass('resmenu');

    if ( (nav.offset().top > nav.prev().offset().top) || ($(items[items.length-1]).offset().top > $(items[0]).offset().top) ) {
      $('body').addClass('resmenu');
    };

  })

    // toggle the menu items' visiblity
    .find('h3').bind('click focus', function(){
      $(this).parent().toggleClass('expanded')
    });

  // update the nav on window events
  $(window).bind('load resize orientationchange', function(){
    $('#navigation').trigger('navfit');
  });

})(jQuery);