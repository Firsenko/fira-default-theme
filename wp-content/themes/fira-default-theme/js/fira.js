jQuery(function($){
	new WOW().init();

    var header = $('#resizeHeader');
    $(window).on('scroll', function () {

        if ($(this).scrollTop() > 100) { //Increase height of scroll event on needed px's to avoid white space in header
            header.addClass('sm-head');
        }
        else {
            header.removeClass('sm-head');
        }
    });
    $(".scroll, .scroll a").click(function(e){e.preventDefault();
        var elemID=$(this).attr('href');
        $('html, body').animate({scrollTop:$(elemID).offset().top-50},1000);});

    $("#nav-tab").on('click', 'a.nav-item', function() {
        if($('a.nav-item').hasClass('active')){
         $('a.nav-item').removeClass('active');
        }
           $(this).addClass('active');
    });

    // remove open menu on mobile
    $('nav li:not(.dropdown, .dropdown-submenu) a').click(function() {
        $(".navbar-collapse").removeClass("show");
    });
    // remove double click safari

    $(".navbar a").on("click touchend", function (e) {
        var el = $(this);
        var link = el.attr("href");
        window.location = link;
    });

    $("a.totop").click(function(e){e.preventDefault();
        var elemID=$(this).attr('href');
    $('body,html').animate({scrollTop:0},200);
    });

    $("#tel").mask("+9(999)999-99-99");

    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop:true,
        nav:true,
        arrow:false,
        margin:0,
        items:1,
        autoplay:true
    });


    $("input, textarea").click(function(){
        $(this).parent().addClass('active');
        if( $(this).parent().siblings().hasClass('active')){
             $(this).parent().siblings().removeClass('active');
        }
    });

// stop the video if modal window is closed
    $(".modal").click(function() {
        var $iframe = jQuery('iframe', jQuery(this)),
            src = $iframe.prop('src');
        $iframe.prop('src', '').prop('src', src.replace('?autoplay=1', ''));
    });
});
$(document).ready(function() {
 
    $('#wpcf7-f14-p141-o1 form').submit(function(e) {
        e.preventDefault();
        var first_name = $('#first_name').val();
        var email = $('#email').val();
        var message = $('#message').val();
     
        $(".error").remove();
     
        if (first_name.length < 1) {
          $('#name').after('<span class="error">This field is required</span>');
           $(this).parent().removeClass('active');
        }

        if (message.length < 1) {
          $('#message').after('<span class="error">This field is required</span>');
           $(this).parent().removeClass('active');
        }
        if (email.length < 1) {
          $('#email').after('<span class="error">This field is required</span>');
           $(this).parent().removeClass('active');
        } else {
          var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
          var validEmail = regEx.test(email);
          if (!validEmail) {
            $('#email').after('<span class="error">Enter a valid email</span>');
          }
        }

      });

// Cache selectors
    if($('body').hasClass('home')){
        var topMenu = $("#mainmenu"),
            topMenuHeight = $('#resizeHeader').outerHeight()+335,
            menuItems = topMenu.find("a:not(#calltoaction-button)"),
            scrollItems = menuItems.map(function(){
                var item = $($(this).attr("href"));
                if (item.length) { return item; }
            });
        //console.log(scrollItems);
        $(window).scroll(function(){
            if($(window).width()>976){
                var fromTop = $(this).scrollTop()+topMenuHeight;
                //console.log(fromTop);
                var cur = scrollItems.map(function(){
                    if ($(this).offset().top < fromTop)
                        return this;
                });
                //console.log(cur);
                if(cur.length){
                    cur = cur[cur.length-1];
                    //console.log(cur);
                    var id = cur && cur.length ? cur[0].id : "";
                    //console.log(id);
                    menuItems.parent().removeClass("active").end().filter("[href='#"+id+"']").parent().addClass("active");
                }else{
                    menuItems.parent().removeClass("active");
                }
            }
        });
    }
});


