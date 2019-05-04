$(function () {
    // Include "node_modules/slidebars/dist/slidebars.js", "node_modules/slidebars/dist/slidebars.css", 

    // Initialize Slidebars
    var controller = new slidebars();
    controller.init();

    $(".js-slidebar-btn").click(function () {
        event.stopPropagation();
        event.preventDefault();

        controller.toggle( 'nav' );
    });

    // Close any
    $( document ).on( 'click', '.js-close-any', function ( event ) {
        if ( controller.getActiveSlidebar() ) {
            event.preventDefault();
            event.stopPropagation();
            controller.close();
        }
    } );

    // Add close class to canvas container when Slidebar is opened
    $( controller.events ).on( 'opening', function ( event ) {
        $( '[canvas]' ).addClass( 'js-close-any' );
    } );

    // Remove close class from canvas container when Slidebar is closed
    $( controller.events ).on( 'closing', function ( event ) {
        $( '[canvas]' ).removeClass( 'js-close-any' );
    } );
});