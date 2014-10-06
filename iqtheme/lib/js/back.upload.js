jQuery(function($) {

    var file_frame;

    $(document).on('click', 'a.membership-add', function(e) {
        e.preventDefault();
        var _parent = jQuery(this).parents('.section_container');

        if (file_frame) file_frame.close();

        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader-title'),
            // Tell the modal to show only images.
            library: {
                type: 'image'
            },
            button: {
                text: $(this).data('uploader-button-text')
            },
            multiple: false
        });

        file_frame.on('select', function() {
            var listIndex = $('.membership_options-list li').index($('.membership_options-list li:last')),
                selection = file_frame.state().get('selection');

            selection.map(function(attachment) {
                attachment = attachment.toJSON();

                    index      = listIndex;

//                _parent.find('.image-uploader-meta-box-list').show();
//                $('input[name="_membership_poster_img"]').val(attachment.url);
                _parent.find('.membership_tb').val(attachment.id);
                _parent.find('a.membership-add').addClass('none');
                _parent.find('a.change-image').removeClass('none');
                _parent.find('a.remove-image').removeClass('none').show();
//                _parent.find('img.image-preview').attr('src', attachment.sizes.full.url);
                _parent.find('.image_preview').css('background-image', 'url('+attachment.sizes.full.url+')');

            });
        });

        file_frame.open();

    });

    $(document).on('click', 'a.change-image', function(e) {

        e.preventDefault();

        var that = $(this);
        if (file_frame) file_frame.close();

        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader-title'),
            button: {
                text: $(this).data('uploader-button-text')
            },
            multiple: false
        });

        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            that.parents('.section_container').find('.membership_tb').attr('value', attachment.id);
//            that.parents('.section_container').find('img.image-preview').attr('src', attachment.sizes.full.url);
            that.parents('.section_container').find('.image_preview').css('background-image', 'url('+attachment.sizes.full.url+')');
        });

        file_frame.open();

    });

    function resetIndex() {
        $('.membership_options-list li').each(function(i) {
            $(this).find('input:hidden').attr('name', 'membership_poster_img');
        });
    }

    $(document).on('click', 'a.remove-image', function(e) {
        var _parent = $(this).parents('.section_container');
        _parent.find('a.membership-add').removeClass('none');
        _parent.find('a.change-image').addClass('none');
        _parent.find(this).addClass('none');

        _parent.find('input.membership_tb').val('');

//        _parent.find('.image_preview li').animate({ opacity: 0 }, 200, function() {
////            $(this).remove();
//            resetIndex();
//        });
//        _parent.find('.image-uploader-meta-box-list').hide();
//        _parent.find('.image-preview').attr('src', '');
        _parent.find('.image_preview').css('background-image', 'none');



        e.preventDefault();

    });

});