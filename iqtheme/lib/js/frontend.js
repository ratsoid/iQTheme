function sidebar() {
    var _sb = jQuery('#sidebar');
    _sb.removeClass('open');
    var _prev = _sb.prev();
    _prev.removeClass('inactive');
    _sb.on('click', function(){
        if(!jQuery(this).hasClass('open')) jQuery(this).addClass('open');
        if(!_prev.hasClass('open')) _prev.addClass('inactive');
    });

    _prev.on('click', function(){
        sidebar();
    })
}

jQuery(document).ready(function(){
    jQuery.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));

    jQuery('.flip-container').each(function(){
       var _bg = jQuery(this).find('.flip-paragraph span').css('backgroundColor');
       var _url = jQuery(this).find('.flip-paragraph a').attr('href');
//       var _flipper = jQuery(this).find('.flipper');
       var _back = jQuery(this).find('.back');
       _back.css({backgroundColor: _bg});
//        _back.wrap('<a href="'+_url+'"></a>')
    });

    function toggleCodes(on) {
        var obj = document.getElementById('icons');

        if (on) {
            obj.className += ' codesOn';
        } else {
            obj.className = obj.className.replace(' codesOn', '');
        }
    }

    var windowH = jQuery(window).height();
    var wrapperH = jQuery('section.fullsize').height();
    if(windowH > wrapperH) {
        jQuery('section.fullsize').css({'height':(jQuery(window).height() + 40)+'px'});
    }

    jQuery('#nav li').hover(
        function () {
            jQuery(this).addClass("hover");
//            jQuery('.sub-menu', this).stop(true,true).slideDown('fast');
        },
        function () {
            jQuery(this).removeClass("hover");
//            jQuery('.sub-menu', this).stop(true,true).slideUp('fast');
        }
    );

    jQuery(window).load(function(){
        if(jQuery.browser !== 'device') {
            jQuery(".site-header.fixed").sticky({ topSpacing: 0 });
            jQuery('.parallax').scrolly({bgParallax: true});
        }
    });

    jQuery('.open_menu').on('click', function(){
        jQuery('body').toggleClass('menu-on');
        return false;
    });

//    jQuery("section p, #sidebar").fitVids();

    var _root = jQuery('html, body');
    jQuery('a').click(function() {
        var href = jQuery.attr(this, 'href');
        _root.animate({
            scrollTop: jQuery(href).offset().top-100
        }, 300, function () {
            window.location.hash = href;
        });
        return false;
    });

    jQuery('.scrollfx.fxfade').addClass("hidden").viewportChecker({
        classToAdd: 'fxfade-visible animated fadeIn',
        offset: 402
    });

    jQuery('.scrollfx.fxpulse').viewportChecker({
        classToAdd: 'animated pulse',
        offset: 402
    });

    jQuery('.scrollfx.fxbounce').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated bounceIn',
        offset: 402
    });

    jQuery('.scrollfx.fxbounceleft').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated bounceInLeft',
        offset: 402
    });

    jQuery('.scrollfx.fxbounceright').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated bounceInRight',
        offset: 402
    });

    jQuery('.scrollfx.fxtada').viewportChecker({
        classToAdd: 'animated tada',
        offset: 402
    });

    jQuery('.scrollfx.fxflip').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated flipInX',
        offset: 402
    });

    jQuery('.scrollfx.fxflip').addClass("hidden").viewportChecker({
        classToAdd: 'visible animated flipInX',
        offset: 402
    });

    jQuery('.iq-faq h2').on('click', function(){
        var _parent = jQuery(this).parent();
        _parent.siblings().removeClass('open');
        if(_parent.hasClass('autoclose')) {
            _parent.siblings().find('.iq-faqContent').slideUp();
        }
        _parent.toggleClass('open');
        jQuery(this).next('.iq-faqContent').slideToggle();

        return false;
    });

    jQuery('.iq-faq h2').on('click', function(e){


    });

    jQuery('.closescroll').on('click', function(){
        jQuery(this).parent().remove();
    });

    jQuery('.ct-1 time').countDown({
        with_separators: false
    });
    jQuery('.ct-2 time').countDown({
        css_class: 'countdown-alt-1',
        with_separators: false
    });
    jQuery('.ct-3 time').countDown({
        css_class: 'countdown-alt-2',
        with_separators: false
    });
    jQuery('.ct-4 time').countDown({
        css_class: 'countdown-alt-3',
        with_separators: false
    });

    sidebar();

});

jQuery(window).resize(function() {
    if( jQuery(window).width()< 991){
        sidebar();
    }
});

jQuery(window).bind("scroll", function() {
    var _px = jQuery('.scrollpx').val();
    if (jQuery(this).scrollTop() > _px) {
        jQuery("#scrollnote").fadeIn();
    } else {
        jQuery("#scrollnote").stop().fadeOut();
    }
});