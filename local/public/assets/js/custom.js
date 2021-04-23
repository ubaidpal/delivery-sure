$(document).ready(function () {

    function checkIfEmpty() {
        var empty = true;
        $('.form-control-animate-border').each(function () {
            if ($(this).val().trim() != "") {
                empty = false;
                $(this).closest(".form-group").addClass("focus");
            } else {
                $(this).closest(".form-group").removeClass("focus");
            }
        });
        return empty;
    }

    checkIfEmpty();

    $("#loginBtn").click(function () {
        checkIfEmpty();
    });
    // Set Middle Content min-height
    var setElementHeight = function () {
        var height = $(window).height() - 124;

        $('.autoheight').css('min-height', (height));

    };

    $(window).on("resize", function () {
        setElementHeight();
    }).resize();


    // Set Messenger Content min-height
    var setMessengerHeight = function () {
        var height = $(window).height() - 340;

        $('.messengerheight').css('min-height', (height));

    };

    $(window).on("resize", function () {
        setMessengerHeight();
    }).resize();


    //Form Label Animation - On Input Focus
    $(".form-control-animate-border").focus(function () {
        $(this).closest(".form-group").addClass("focus");

    }).blur(function () {
        if (!$(this).val()) {
            $(this).closest(".form-group").removeClass("focus");
        }
    });


});

$(function () {
    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: true,
        placement: function (context, source) {
            var offset = $(source).offset(),
                top = offset.top,
                left = offset.left,
                height = $(document).outerHeight(),
                width = $(document).outerWidth(),
                vert = 0.5 * height - top,
                vertPlacement = vert > 0 ? 'bottom' : 'top',
                horiz = 0.5 * width - left,
                horizPlacement = horiz > 0 ? 'right' : 'left';
            //placement = Math.abs(horiz) > Math.abs(vert) ?  horizPlacement : vertPlacement;
            if (Math.abs(horiz) > Math.abs(vert)) {
                return horizPlacement;
            } else {
                return vertPlacement
            }
        },
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).children(".popover-body").html();
        },
        title: function () {
            // var title = $(this).attr("data-popover-content");
            //return $(title).children(".popover-heading").html();
        }
    })

    $('[data-hover="dropdown"]').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
    });
})
