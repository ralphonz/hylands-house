/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  //Window width variable for responsive javascript
  var viewport = $(window);
  var windowWidth = viewport.width();

  /*
   * Convert the archives widget to a drop down for small devices
   * @since 1.0
   */
  function widget_archive() {
    if (windowWidth < 768) {
      // Create the dropdown base if it doesn't exist yet
      if($(".newsletter-navigation select").length < 1) {
        $("<select />").appendTo(".newsletter-navigation");

        // Create default option "Go to..."
        $("<option />", {
           "selected": "selected",
           "value"   : "",
           "text"    : "Select Month..."
        }).appendTo(".newsletter-navigation select");

        // Populate dropdown with menu items
        $(".newsletter-navigation a").each(function() {
         var el = $(this);
         $("<option />", {
             "value"   : el.attr("href"),
             "text"    : el.text()
         }).appendTo(".newsletter-navigation select");
        });
      } else {
        //otherwise lets just show the drop down again
        $("..newsletter-navigation select").show();
      }

      //Hide the archive list
      $(".newsletter-navigation ul").hide();

      // Make the dropdown actually work
      $(".newsletter-navigation select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
    } else {
      // if the window is bigger...
      //Show the archive list
      $(".newsletter-navigation ul").show();
      // And hide the select box
      $(".newsletter-navigation select").hide();

    }
  }


  /*
    * Scroll the newsletter navigation using the buttons
    * @since 1.0
    */
  function newsletter_nav() {
    var scrollVal = $(".newsletter-navigation .nav-item").outerWidth() + 28;
    var activeItem = $(".newsletter-navigation .active");
    if (activeItem.length > 0) {
      activeItem.get(0).scrollIntoView();
    }
    $('.newsletter-navigation .next-arrow').click(function() {
     event.preventDefault();
     $('.newsletter-navigation .nav').animate({
       scrollLeft: "+="+scrollVal+"px"
     }, "400");
    });

    $('.newsletter-navigation .prev-arrow').click(function() {
      event.preventDefault();
      $('.newsletter-navigation .nav').animate({
        scrollLeft: "-="+scrollVal+"px"
      }, "400");
    });
  }

  /*
   * Add bootstrap collapse class to menu is on mobile device or tablet
   * @since 1.0
   */
   function collapse_nav() {
    if (windowWidth < 992) {
      $('.navbar-collapse').addClass('collapse');
    } else {
      $('.navbar-collapse').removeClass('collapse');
    }
   }

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        viewport.resize(function() {
          windowWidth = viewport.width();
        });

        if (windowWidth >= 575) {
          //gallery flex - calculate aspect ratio and return as flex-grow in flex shorthad property
          $('.gallery-item').each(function(){
            var value = $("img", this).width() / $("img", this).height();
            $(this).css("flex", value + ' 1 0%');
          });
        }

        //Bootstrap collapse menu for smaller devices
        collapse_nav();
        $(window).resize(function(){ 
          collapse_nav();
        });

        $( ".navbar a" ).click(function(e) {
            e.preventDefault();
            var newLocation = this.href;
            $(".pagefade").fadeOut(100); 
            $(".banner").addClass('banner-out');
            $(".main").fadeOut(400, function(){
              window.location = newLocation;
            });
          }
        );

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'blog': {
      init: function() {

        widget_archive();
        $(window).resize(function(){ 
          widget_archive();
        });

        newsletter_nav();

      }
    },
    'archive': {
      init: function() {

        widget_archive();
        $(window).resize(function(){ 
          widget_archive();
        });

        newsletter_nav();
      }
    },
    'single': {
      init: function() {

        widget_archive();
        $(window).resize(function(){ 
          widget_archive();
        });

        newsletter_nav();

      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
