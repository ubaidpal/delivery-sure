/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 14-Jun-16 11:29 AM
 * File Name    :
 */
$(document).ready(function () {
    $('body').on('click', 'a[data-toggle="modal"]', function (e) {

        var href = e.currentTarget.getAttribute('href');
        if (!href || href.indexOf('#') === 0) {
            return;
        }
        // From the clicked element, get the data-target arrtibute
        // which BS3 uses to determine the target modal
        var target_modal = $(e.currentTarget).data('target');
        // also get the remote content's URL
        var remote_content = e.currentTarget.href;
        //var header_content = $(e.currentTarget).data('header');

        // Find the target modal in the DOM
        var modal = $(target_modal);
        // Find the modal's <div class="modal-body"> so we can populate it
        var modalBody = $(target_modal + ' .modal-body');
        var modalHeader = $('#modal-header');
        // Capture BS3's show.bs.modal which is fires
        // immediately when, you guessed it, the show instance method
        // for the modal is called
        modal.off('show.bs.modal');
       // modalHeader.text(header_content);
        modal.on('show.bs.modal', function () {
            // use your remote content URL to load the modal body
            modalBody.load(href);

        }).modal();
        // and show the modal

        // Now return a false (negating the link action) to prevent Bootstrap's JS 3.1.1
        // from throwing a 'preventDefault' error due to us overriding the anchor usage.
        return false;
    });
})
