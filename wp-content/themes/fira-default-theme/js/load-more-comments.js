jQuery(function($){

    // load more button click event
    $('.reviews_comment_loadmore').click( function(){
        var button = $(this);

        // decrease the current comment page value
        cpage--;

        $.ajax({
            url : ajaxurl, // AJAX handler, declared before
            data : {
                'action': 'cloadmore', // wp_ajax_cloadmore
                'post_id': parent_post_id, // the current post
                'cpage' : cpage, // current comment page
            },
            type : 'POST',
            beforeSend : function ( xhr ) {
                button.text('Загрузка...'); // preloader here
            },
            success : function( data ){
                if( data ) {
                    $('div.comments').append( data );
                    button.text('Больше отзывов');
                    // if the last page, remove the button
                    if ( cpage == 1 )
                        button.remove();
                } else {
                    button.remove();
                }
            }
        });
        return false;
    });

});

