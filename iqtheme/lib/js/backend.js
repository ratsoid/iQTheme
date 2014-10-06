jQuery(document).ready(function(){

    $ = jQuery;

    function toggleCodes(on) {
        var obj = document.getElementById('icons');

        if (on) {
            obj.className += ' codesOn';
        } else {
            obj.className = obj.className.replace(' codesOn', '');
        }
    }

    jQuery('.membership_tabgo').on('click', function(){
        var _parent = jQuery(this).parent().attr('id');
        jQuery('.membership_tab').removeClass('active').hide();
        jQuery('.membership_tabgo').removeClass('active');
        jQuery(this, _parent).addClass('active');
        jQuery('.'+_parent).show();
        return false;
    });

    jQuery('.membership_pagego').on('click', function(){
        var _parent = jQuery(this).parent().attr('id');
        jQuery('.page_tab').removeClass('active').hide();
        jQuery('.membership_pagego').removeClass('active');
        jQuery(this, _parent).addClass('active');
        jQuery('.'+_parent).fadeIn('fast');
        return false;
    });

    jQuery('#add_section').on('click', function(e){
        jQuery(this).attr('disabled');
        var _sel = jQuery('#section_list option:selected');
        var _id = _sel.attr('id').split('_')[1];
        var _title = _sel.text();
        var _last = jQuery('#sections li.section_container:last').attr('data-post-id');
        if(jQuery('#sections li').length < 1) {
            var _section = 0;
        } else {
            var _section = parseInt(_last, 10) + 1;
        }

        var _html = '<li data-post-id="'+ _section +'" class="section_container">' +
            '<input class="section_order" name="section[]" type="hidden" value="'+_section+'" />' +
            '<input class="section_id" name="section['+ _section +'][id]" type="hidden" value="'+_id+'" />' +
            '<h3 class="section_title">'+ _title +'</h3> - Please Save Draft' +
            '</li>';

        jQuery('#sections').append(_html);
        jQuery(this).removeAttr('disabled');
        return false;
    });

    jQuery('.delete_section').on('click', function(){
        var _parent = jQuery(this).parents('.section_container');
        if(jQuery('.section_container').length < 2) return false;
        _parent.nextAll('.section_container').each(function()
        {
            var _order = jQuery(this).find('.section_order');
            var _new = parseInt(_order.val(), 10) - 1;
            _order.val(_new);
            jQuery(this).attr('data-post-id', _new);
            jQuery(this).find('.section_id').attr('name', 'section['+_new+'][id]')
        });
        _parent.fadeOut().remove();
        return false;
    });

    jQuery( "#sections" ).sortable({
        update: function(event, ui) {

            jQuery('#console').html('<b>posts[id] = pos:</b><br>');
            jQuery('#sections').children().each(function(i) {

                var id = jQuery(this).attr('data-post-id'),
                    order = jQuery(this).index() ;
                jQuery(this).find('.section_order').val(order);
                jQuery(this).find('.replace_id').each(function(){
                    jQuery(this).attr('name', jQuery(this).attr('name').replace(/[0-9]+/, order));
                });
            });

        }
    });

    jQuery('.membership_color').wpColorPicker({
        hide: true,
        change: function(event, ui){
            if(jQuery(this).hasClass('colorPreview')) {
                var _option = jQuery(this).parents('.wp-picker-container').find('.section_preview').attr('data-preview');
                var _value = jQuery(this).parents('.wp-picker-container').find('.section_preview').val();
                jQuery(this).parents('.section_container').find('.image_preview').css(_option, _value);
            }
        }
    });

    jQuery('.toggle_mo').on('click', function(){
        $(this).parents('.section_container').find('.membership_options_container').slideToggle('fast');
        $(this).parents('.section_container').find('.section_title').toggleClass('active');
        return false;
    });

    jQuery('#sections .section_preview').on('change', function(){
        var _option = jQuery(this).attr('data-preview');
        var _value = jQuery(this).val();
        if(jQuery(this).is('[data-value]') && jQuery(this).is(':checked')) {
            _value = jQuery(this).attr('data-value');
        } else if(jQuery(this).is('[data-value]'))
        {
            _value = jQuery(this).attr('data-value-none');
        } else if(jQuery(this).hasClass('bgpos')) {
            var _preview = jQuery(this).parents('.section_container').find('.image_preview'),
                _bgpos = _preview.css('backgroundPosition').split(' ');
            if(jQuery(this).is('[data-bg-y]')) {
                var _value = _bgpos[0] + ' ' +jQuery(this).val();
            }

            else if(jQuery(this).is('[data-bg-x]')) {
                var _value = _bgpos[1] + ' ' +jQuery(this).val();
            }
        }

        jQuery(this).parents('.section_container').find('.image_preview').css(_option, _value);
        jQuery('.preview_update').delay(200).fadeIn('slow').delay(50).fadeOut('slow');

    });

});