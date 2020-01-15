/**
 * Created by GCG on 28.05.2019.
 */

$(document).ready(function() {

    var form = $('.form-send-mail'),
        action = form.attr('action'),
        pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

    form.find('.req-field').addClass('empty-field');

    function checkInput() {
        form.find('.req-field').each(function () {
            var el = $(this);
            if (el.hasClass('rf-mail')) {
                if (pattern.test(el.val())) {
                    el.removeClass('empty-field');
                } else {
                    el.addClass('empty-field');
                }
            } else if (el.val() != '') {
                el.removeClass('empty-field');
            } else {
                el.addClass('empty-field');
            }
        });
    }

    function lightEmpty() {
        form.find('.empty-field').addClass('rf-error');
        setTimeout(function () {
            form.find('.rf-error').removeClass('rf-error');
        }, 1000);
    }


    $(document).on('submit', '.form-send-mail', function (e) {
        var formData = {
            client_fio: $('#inputFirstname').prop('value'),
            client_tel: $('#inputTel').prop('value'),
            client_mail: $('#inputEmail').prop('value'),
            client_sum: $('#inputSum').prop('value')
        };

        $.ajax({
            type: 'POST',
            url: action,
            data: formData,
            beforeSend: function () {
                form.addClass('is-sending');
            },
            error: function (request, txtstatus, errorThrown) {
                console.log(request);
                console.log(txtstatus);
                console.log(errorThrown);
            },
            success: function () {
                form.removeClass('is-sending').addClass('is-sending-complete');
            }
        });

        e.preventDefault();

    });

    $(document).on('click', '.form-send-mail button[type="submit"]', function (e) {

        checkInput();

        var errorNum = form.find('.empty-field').length;

        if (errorNum > 0) {
            lightEmpty();
            e.preventDefault();
        }

    });

    $(document).on('click', '.form-is-more button', function () {

        form.find('input').val('');

        form.find('textarea').val('');

        form.removeClass('is-sending-complete');

    });

});
