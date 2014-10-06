/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */

(function ( $ ) {

    $.fn.alterClass = function ( removals, additions ) {

        var self = this;

        if ( removals.indexOf( '*' ) === -1 ) {
            // Use native jQuery methods if there is no wildcard matching
            self.removeClass( removals );
            return !additions ? self : self.addClass( additions );
        }

        var patt = new RegExp( '\\s' +
            removals.
                replace( /\*/g, '[A-Za-z0-9-_]+' ).
                split( ' ' ).
                join( '\\s|\\s' ) +
            '\\s', 'g' );

        self.each( function ( i, it ) {
            var cn = ' ' + it.className + ' ';
            while ( patt.test( cn ) ) {
                cn = cn.replace( patt, ' ' );
            }
            it.className = $.trim( cn );
        });

        return !additions ? self : self.addClass( additions );
    };

})( jQuery );

( function( $ ) {

    // Update the site title in real time...
    wp.customize( 'blogname', function( value ) {
        value.bind( function( newval ) {
            $( '#site-title a' ).html( newval );
        } );
    } );

    //Update the site description in real time...
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( newval ) {
            $( '.site-description' ).html( newval );
        } );
    } );

    //Update site title color in real time...
    wp.customize( 'header_color', function( value ) {
        value.bind( function( newval ) {
            $('.header-color .site-title, .header-color').css('color', newval );
        } );
    } );

    //Update site background color...
    wp.customize( 'background_color', function( value ) {
        value.bind( function( newval ) {
            $('body').css('background-color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'site_color', function( value ) {
        value.bind( function( newval ) {
            $('#header .site-description').css('background-color', newval );
            $('a').css('color', newval );
            $('nav#nav .menu > li:hover > a, nav#nav .menu > li > a:hover, #wrapper *').css('border-color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'header_background', function( value ) {
        value.bind( function( newval ) {
            $('.header-background').addClass('noafter').css('background-color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'footer_background', function( value ) {
        value.bind( function( newval ) {
            $('.footer-background').css('background-color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'footer_color', function( value ) {
        value.bind( function( newval ) {
            $('.footer-color').css('color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'fixed_header', function( value ) {
        value.bind( function( newval ) {
            $('.site-header').toggleClass('fixed').removeClass('is-sticky');
//            $('.site-header').parent().toggleClass('sticky-wrapper is-sticky');
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'hide_search', function( value ) {
        value.bind( function( newval ) {
            if(newval == false) {
                $('.header-search').show();
                $('#nav').css('right', '30px')
            } else if(newval == true ) {
                $('.header-search').hide();
                $('#nav').css('right', '0')
            }
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'hide_social', function( value ) {
        value.bind( function( newval ) {
            if(newval == false) {
                $('.footer-social').show();
            } else if(newval == true ) {
                $('.footer-social').hide();
            }
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'hide_desc', function( value ) {
        value.bind( function( newval ) {
            if(newval == false) {
                $('header .site-description').css('opacity', '1');
            } else if(newval == true ) {
                $('header .site-description').css('opacity', '0');
            }
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'font_menu', function( value ) {
        value.bind( function( newval ) {
            $('nav#nav').toggleClass('header-font').css('font-family', '')
        } );
    } );

    wp.customize( 'header_size', function( value ) {
        value.bind( function( newval ) {
            if(newval == false) {
                $('.site-header').css({backgroundSize: 'auto'});
            } else if(newval == true ) {
                $('.site-header').css({backgroundSize: newval});
            }
        } );
    } );

    wp.customize( 'footer_size', function( value ) {
        value.bind( function( newval ) {
            if(newval == false) {
                $('.site-footer').css({backgroundSize: 'auto'});
            } else if(newval == true ) {
                $('.site-footer').css({backgroundSize: 'contain'});
            }
        } );
    } );

    wp.customize( 'sidebar_size', function( value ) {
        value.bind( function( newval ) {
            if(newval == '3') {
                $('#sidebar').css({'width': "350px", 'flex': '0 0 350px', '-webkit-flex': '0 0 200px'});
            } else if(newval == '2') {
                $('#sidebar').css({'width': "300px", 'flex': '0 0 300px', '-webkit-flex': '0 0 200px'});
            } else if(newval == '1') {
                $('#sidebar').css({'width': "250px", 'flex': '0 0 250px', '-webkit-flex': '0 0 200px'});
            } else if(newval == '0') {
                $('#sidebar').css({'width': "200px", 'flex': '0 0 200px', '-webkit-flex': '0 0 200px'});
            }
        } );
    } );

    wp.customize( 'footer_style', function( value ) {
        value.bind( function( newval ) {
            jQuery('#footer-widgets').removeClass();
            if(newval == 0) {

            } else if(newval == 1 ) {
                $('#footer-widgets').addClass('footer-flex');
            } else if(newval == 2 ) {
                $('#footer-widgets').addClass('footer-row');
            }
        } );
    } );

    wp.customize( 'body_font', function( value ) {
        value.bind( function( newval ) {
            jQuery('body').css('font-family', newval);
        } );
    } );

    wp.customize( 'header_font', function( value ) {
        value.bind( function( newval ) {
            jQuery('.header-font').css('font-family', newval);
        } );
    } );

    wp.customize( 'site_width', function( value ) {
        value.bind( function( newval ) {
            jQuery('#header,.sections .post-content,article.post,article.page,#footer,#content.bloop,.site_width').css('max-width', newval);
        } );
    } );

    wp.customize( 'header_fontsize', function( value ) {
        value.bind( function( newval ) {
            jQuery('.site-header').alterClass( 'size*');
            jQuery('.site-header').addClass(newval);
        } );
    } );

    wp.customize( 'header_pos', function( value ) {
        value.bind( function( newval ) {
            jQuery('.site-header').css({backgroundRepeat: newval});
        } );
    } );

    wp.customize( 'footer_pos', function( value ) {
        value.bind( function( newval ) {
            jQuery('.site-footer').css({backgroundRepeat: newval});
        } );
    } );

    wp.customize( 'header_align', function( value ) {
        value.bind( function( newval ) {
            jQuery('.site-header').css({backgroundPosition: newval});
        } );
    } );

    wp.customize( 'footer_align', function( value ) {
        value.bind( function( newval ) {
            jQuery('.site-footer').css({backgroundPosition: newval});
        } );
    } );

    wp.customize( 'header_bg', function( value ) {
        value.bind( function( newval ) {

            $( '.site-header' ).css({
                backgroundImage: ' url('+newval+')',
                backgroundRepeat: 'repeat'
            }).addClass(newval);
        } );
    } );

    wp.customize( 'footer_bg', function( value ) {
        value.bind( function( newval ) {

            $( '.site-footer' ).css({
                backgroundImage: ' url('+newval+')',
                backgroundRepeat: 'repeat'
            }).addClass(newval);
        } );
    } );

} )( jQuery );