/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 22-Jun-16 6:33 PM
 * File Name    :
 */
$(function () {
    $('.items').click(function () {
        var id = $(this).val();
        var purchased = 0;
        if ($(this).is(":checked")) {
            purchased = 1;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });

        $.ajax({
            type: 'POST',
            url: '/checklist',
            data: {id: id, purchased: purchased},
            success: function () {
                if ($('.items:checked').length == $('.items').length) {

                    $('#ready-depart').attr('disabled', false)
                }else{

                    $('#ready-depart').attr('disabled', true)
                }
            }
        })
    });


    $('#ready-depart').click(function (e) {
        if ($('.items:checked').length < $('.items').length) {
            e.preventDefault();
        }
    })
});
