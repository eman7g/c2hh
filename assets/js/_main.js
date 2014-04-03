// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var C2HH = {
  // All pages
  common: {
    init: function() {
      
      //Product Slider
      $('.product-slider').bxSlider({
        pagerCustom: '#product-pager',
        mode: 'fade',
        infiniteLoop: false,
        adaptiveHeight: true,
        controls: false,
        preloadImages:'visible'
      });


      //Featured Slider
      $('.featured-slider').bxSlider({
        //pagerCustom: '#product-pager',
        mode: 'fade',
        infiniteLoop: false,
        adaptiveHeight: true,
        controls: false,
        preloadImages:'visible'
      });


      //Hover Feature Links
      $(".learn-more").on({
          mouseenter: function () {
              $(this).parent().parent().find('.images span').addClass('hover');
          },
          mouseleave: function () {
              $(this).parent().parent().find('.images span').removeClass('hover');
          }
      });

      $('.panel-title a').on('click', function (e) {
        $(this).addClass('active');
           //$(e.target).prev('.panel-heading').find('.panel-title a').addClass('active');
      });

      $('.panel-title a').on('hide', function (e) {
          $(this).find('.panel-title a').not($(e.target)).removeClass('active');
      });


      $('input.radio').iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal',
        increaseArea: '20%' // optional
      });

      $('select.form-control').dropkick();
      
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
      // JS here
    }
  },
  // products page
  products: {

    init: function() {

      var $content = $(".product-grid");

      $('#productFilterForm').submit(function(){

        var productFilterQuery = $(this).serialize();

        //console.log(productFilterQuery);

        // product filter ajax request
        $.ajax({
          type : 'post',
          url: myAjax.ajaxurl,
          data: {
            'action':'product_filter',
            'filterQuery' : productFilterQuery,
            'nextNonce' : myAjax.nextNonce
          },
          beforeSend : function(){
            $content.empty();
            $content.append('<div id="temp_load" style="text-align:center"><img src="/wp-content/themes/c2hh/assets/img/ajax-loader.gif" /></div>');
          },
          success:function(data) {
            // This outputs the result of the ajax request
            console.log(data);
            var $data = $(data);
            if($data.length){
                $("#temp_load").remove();
                $data.hide();
                $content.append($data);
                $data.fadeIn(500);
            } else {
                $("#temp_load").remove();
            }
          },
          error: function(errorThrown){
              console.log(errorThrown);
          }
        });

        return false;

      });
      
    }
  }
};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = C2HH;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {

    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });

    UTIL.fire('common', 'finalize');
  }
};

$(document).ready(UTIL.loadEvents);

var equalheight = function(container){

  var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = [],
     $el,
     currentDiv,
     topPosition = 0;
  $(container).each(function() {

   $el = $(this);
   $($el).height('auto');
   var topPostion = $el.position().top;

   if (currentRowStart !== topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
    } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
    }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
  });
};

$(window).load(function() {
  equalheight('.block-column');
});


$(window).resize(function(){
  equalheight('.block-column');
});
