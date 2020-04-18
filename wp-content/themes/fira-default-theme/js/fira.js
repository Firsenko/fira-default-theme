jQuery(document).ready(function($) {
	new WOW().init();

    var header = $('#header');
    $(window).on('scroll', function () {

        if ($(this).scrollTop() > 100) { //Increase height of scroll event on needed px's to avoid white space in header
            header.addClass('sticky');
        }
        else {
            header.removeClass('sticky');
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


    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        // disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    /* MASONRY ITEMS */
    var $container = $('.masonry');
    // initialize
    function start_masonry(){
        $container.imagesLoaded(function() {
            $container.masonry({
                itemSelector: '.masonry-item',
                columnWidth: '.masonry-item',
            });
        });
    }
    start_masonry();
    $(window).resize(function(){
        setTimeout( function(){
            start_masonry();
        }, 500);
    });

    $('#contact-form form').submit(function(e) {
        e.preventDefault();
        var first_name = $('#name').val();
        var email = $('#email').val();
        var message = $('#message').val();

        $(".error").remove();

        if (first_name && first_name.length < 1) {
            $('#name').after('<span class="error">This field is required</span>');
            $(this).parent().removeClass('active');
        }

        if (message && message.length < 1) {
            $('#message').after('<span class="error">This field is required</span>');
            $(this).parent().removeClass('active');
        }
        if (email && email.length < 1) {
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

    $(function() {
        // Owl Carousel
        var owl = $(".owl-carousel");
        owl.owlCarousel({
            items: 1,
            margin: 0,
            loop: true,
            autoplay: false,
            autoplayTimeout: 2000,
            smartSpeed: 1000,
            nav: true,
            mouseDrag:false,
            touchDrag:false,
            pullDrag:false,
            animateOut: 'slideOutRight',
            animateIn: 'slideInLeft',
            dots: true
        });
    });

     $('.profile-link').magnificPopup({type:'image'});


    $(function () {
        $('#datetimepicker').datetimepicker({
            ampm: true,
            timepicker:false,
            format: 'Y/m/d',
            inline:false,
            minDate:0,
            sideBySide:false,
            defaultDate:new Date(),
            startDate:new Date(),
            dayOfWeekStart:1,
            defaultSelect:true
        });
    });
    $(function() {
        $('#timepicker').datetimepicker({
            datepicker:false,
            format:'h:i A',
            formatTime: 'h:i A',
            allowTimes:['8:00','8:30','9:00','9:30','10:00','10:30','11:00','11:30',
                '12:00','12:30', '13:00', '13:30', '14:00','14:30', '15:00','15:30',
                '16:00','16:30','17:00','17:30', '18:00']
            // disableTimeRanges: [['12:00am', '7:30am'],['7:30pm', '11:30pm']]
        });
    });
    // Accordion
    $("#accordion .card-header").click(function () {
        $(this).parent().siblings().removeClass('active');
        if($(this).parent().hasClass('active')){
            $(this).parent().removeClass('active');
        }
        else{
            $(this).parent().addClass('active');
        }
    });
// // Cache selectors
//     if($('body').hasClass('home')){
//         var topMenu = $("#mainmenu"),
//             topMenuHeight = $('#resizeHeader').outerHeight()+335,
//             menuItems = topMenu.find("a:not(#calltoaction-button)"),
//             scrollItems = menuItems.map(function(){
//                 var item = $($(this).attr("href"));
//                 if (item.length) { return item; }
//             });
//         //console.log(scrollItems);
//         $(window).scroll(function(){
//             if($(window).width()>976){
//                 var fromTop = $(this).scrollTop()+topMenuHeight;
//                 //console.log(fromTop);
//                 var cur = scrollItems.map(function(){
//                     if ($(this).offset().top < fromTop)
//                         return this;
//                 });
//                 //console.log(cur);
//                 if(cur.length){
//                     cur = cur[cur.length-1];
//                     //console.log(cur);
//                     var id = cur && cur.length ? cur[0].id : "";
//                     //console.log(id);
//                     menuItems.parent().removeClass("active").end().filter("[href='#"+id+"']").parent().addClass("active");
//                 }else{
//                     menuItems.parent().removeClass("active");
//                 }
//             }
//         });
//     }
});


