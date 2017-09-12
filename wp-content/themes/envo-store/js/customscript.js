// scroll to top button
jQuery( document ).ready( function ( $ ) {
    // Lazy load images
    $( "img" ).unveil( 200, function () {
        $( this ).load( function () {
            this.style.opacity = 1;
        } );
    } );
    // Menu fixes
    $( function () {
        $( ".dropdown" ).hover(
            function () {
                $( this ).addClass( 'open' )
            },
            function () {
                $( this ).removeClass( 'open' )
            }
        );
    } );
    $( '.navbar .dropdown-toggle' ).hover( function () {
        $( this ).addClass( 'disabled' );
    } );
    // Home masonry
    if ( $( '.top-grid-products' ).length ) {
        var $grid = $( '.top-grid-products' ).imagesLoaded( function () {
            $grid.masonry( {
                itemSelector: '.products-line'
            } );
        } );
    }
} );

/**
 * jQuery Unveil
 * A very lightweight jQuery plugin to lazy load images
 * http://luis-almeida.github.com/unveil
 *
 * Licensed under the MIT license.
 * Copyright 2013 Luís Almeida
 * https://github.com/luis-almeida
 */

;
( function ( $ ) {

    $.fn.unveil = function ( threshold, callback ) {

        var $w = $( window ),
            th = threshold || 0,
            retina = window.devicePixelRatio > 1,
            attrib = retina ? "data-src-retina" : "data-src",
            images = this,
            loaded;

        this.one( "unveil", function () {
            var source = this.getAttribute( attrib );
            source = source || this.getAttribute( "data-src" );
            if ( source ) {
                this.setAttribute( "src", source );
                if ( typeof callback === "function" )
                    callback.call( this );
            }
        } );

        function unveil() {
            var inview = images.filter( function () {
                var $e = $( this );
                if ( $e.is( ":hidden" ) )
                    return;

                var wt = $w.scrollTop(),
                    wb = wt + $w.height(),
                    et = $e.offset().top,
                    eb = et + $e.height();

                return eb >= wt - th && et <= wb + th;
            } );

            loaded = inview.trigger( "unveil" );
            images = images.not( loaded );
        }

        $w.on( "scroll.unveil resize.unveil lookup.unveil", unveil );

        unveil();

        return this;

    };

} )( window.jQuery || window.Zepto );

