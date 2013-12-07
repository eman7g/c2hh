// Modified http://paulirish.com/2009/markup-based-unobtrusive-comprehensive-dom-ready-execution/
// Only fires on body class (working off strictly WordPress body_class)

var Snyder = {
  // All pages
  common: {
    init: function() {
      
      //Full Width Slider
      $('.carousel').carouFredSel({
        responsive: true,
        items: {
          visible: 1,
          width: 1200,
          height: 726
        },
        scroll: {
          duration: 500,
          timeoutDuration: 5000,
          fx: 'crossfade'
        },
        pagination: '.carousel-pager'
      });

      //Bootstrap Popover
      $('a[data-toggle=popover]').popover({
        trigger: 'click',
        html: 'true'
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
    },
    finalize: function() { }
  },
  // Home page
  home: {
    init: function() {
      // JS here
    }
  },
  // About page
  about: {
    init: function() {
      // JS here
    }
  }
};

var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Snyder;
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