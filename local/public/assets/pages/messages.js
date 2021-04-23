/**
 * Created by   :  Muhammad Yasir
 * Project Name : demedat
 * Product Name : PhpStorm
 * Date         : 25-Jun-16 1:09 PM
 * File Name    :
 */
(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as anonymous module.
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // Node / CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals.
        factory(jQuery);
    }
})(function ($) {
    function Messages() {
        this.$messageSend = $('.send-msg');
        this.$messageBody = $('#message-body');
        this.$attachment = $('#attachment');
        this.$btnAttachment = $('#btn-attachment');
        this.$messageForm = $('#msg-form');
        this.$messageFormBox = $('#message-form-box');
        this.$messageBox = $('#web-messenger');
        this.$conversationHead = $('.conversation-head');
        this.$search = $('#search-input');

        this.init();


    }

    Messages.prototype = {
        Constructor: Messages,
        init: function () {

            this.addEventListener();
        },
        searchConversation: function (ele) {
            var keyword = $(ele.currentTarget).val();
            var search_in = $('.conversation-head');
            search_in.hide();
            var i = 0;
            $('.not-found').remove();
            search_in.each(function (index, element) {
                var text = $(element).find('.message-thread-name').text();
                var title = $(element).find('.message-thread-name').data('title');
                if (text.toLowerCase().indexOf(keyword.toLowerCase()) >= 0 || title.toLowerCase().indexOf(keyword.toLowerCase()) >= 0) {
                    $(this).show();
                    i++;
                } else {
                    //console.log('no')
                }
            });
            if (i == 0) {
                $('<div class="user-msgs-box not-found" style="text-align: center">' + '<h3 >Not Found</h3>' + '<p>No people or conversations named ' + keyword + '</p>' + '</div>').insertAfter('#search-form');
            }
        },
        addEventListener: function () {
            this.$messageSend.on('click', $.proxy(this.saveMessage, this));
            this.$attachment.on('change', $.proxy(this.saveMessage, this));
            this.$btnAttachment.on('click', $.proxy(this.openFileWindow, this));
            this.$conversationHead.on('click', $.proxy(this.loadConversation, this));
            this.$search.on('keyup', $.proxy(this.searchConversation, this));
            $(document).on('keypress', $.proxy(this.keyPress, this));
        },
        saveMessage: function () {
            var data = new FormData(this.$messageForm[0]);
            if (this.$messageBody.val() != '' || this.$attachment.val() != '') {
                this.$messageBody.val('').prop('disabled', true);
                var _this = this;
                this.ajaxSetup();
                $.ajax({
                    type: 'POST',
                    url: this.$messageForm.attr('action'),
                    data: data,
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        _this.submitStart();
                    },
                    success: function (data) {
                        _this.submitDone(data);
                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        _this.submitFail(textStatus || errorThrown);
                    },
                    complete: function () {
                        _this.submitEnd();
                    }
                })
            }
        },
        submitDone: function (data) {
            this.$messageBody.prop('disabled', false);
            var dt = new Date();
            var attachmentHtml = '';
            var file = '';
            if(data.is_closed == 1){
                alert(data.msg);
                return false;
            }
            if (data.file_data.file_type == 'image') {
                file = '<img width="50" src="/photo/' + data.file_data.storage_path + '">'
            }
            if (data.file_data != '') {
                attachmentHtml = '<span class="attachment-icon"></span><div class="linkDownload"><a download="" href="/photo/' + data.file_data.storage_path + '">' + file + '</a><span class="attachment-name">Drawing (2).png</span><span class="attachment-url"><a download="" href="/photo/' + data.file_data.storage_path + '">Download</a></span>';
            }
            var msgHtml = '<li class="messenger-msg-right"><div class="row"><div class="col-sm-7 col-sm-offset-5"><div class="message-thread-img"><img alt="image" src="' + data.profile_picture + '"></div><div class="messenger-msg-content">   <div class="user-name">Me</div><div class="messenger-msg-txt">' + data.message_body + attachmentHtml + '</div><ul class="messenger-msg-time">' + this.time_format(data.time) + '</ul></div></div> </div></li>';
            this.$attachment.val('');
            this.$messageBox.append(msgHtml);
            scroll();

        },
        submitStart: function () {

        },
        submitFail: function (msg) {
            this.$messageBody.prop('disabled', false);
            this.alert(msg);
        },
        submitEnd: function () {

        },
        keyPress: function (e) {
            //e.preventDefault();
            if (e.which == 13) {
                e.preventDefault();
                if ($('.rename-conv').is(':focus')) {
                    rename_conversation();
                } else if (this.$messageBody.is(':focus')) {
                    this.saveMessage();
                }
            }
        },
        openFileWindow: function (e) {
            e.preventDefault();
            this.$attachment.trigger('click');
        },
        showMessageList: function (data, copyConv) {
            //$('.message-thread-group').prepend(copyConv);
            this.$messageBox.html(data);
            this.$messageBody.focus();
            this.$conversationHead = $('.conversation-head');
            this.$conversationHead.unbind('click');
            this.$conversationHead.on('click', $.proxy(this.loadConversation, this));
            scroll();
            //message_box.show();
            //scroll();
            //$('.message-thread-title').show();
        },
        loadConversation: function (ele) {
            /* if($(e.target).hasClass('leave-conv-a')){
             return false;
             }*/

            this.$conversationHead.removeClass('unread');
            //var $this = $(this);
            $(ele.currentTarget).addClass('unread');
            var copyConv = $(ele.currentTarget).clone();
            var chat_title = $(ele.currentTarget).find('.message-thread-name').text();
            var convType = $(ele.currentTarget).data('conv');
            var text = '';
            if(convType == 'admin'){
                 text = '(Delivery Sure Admin)'
            }
            $('.message-thread-title').empty().text(chat_title+' '+text);
            //this.$messageBox.empty();
            var _this = this;
            var url = $(ele.currentTarget).data('url');
            this.ajaxSetup();
            $.ajax({
                type: 'POST',
                url: url,
                cache: true,
                async: false,
                dataType: 'html',
                beforeSend: function () {
                    _this.submitStart();
                },
                success: function (data) {
                    //$(ele.currentTarget).remove();
                    _this.showMessageList(data, copyConv);
                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    _this.submitFail(textStatus || errorThrown);
                },
                complete: function () {
                    _this.submitEnd();
                }
            });


        },

        ajaxSetup: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
        },
        alert: function (msg) {
            var $alert = [
                '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
                '</div>'
            ].join('');

            this.$messageFormBox.before($alert);
        },
        time_format: function (input) {
            var d = new Date(Date.parse(input.replace(/-/g, "/")));
            var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            var date = month[d.getMonth()] + " " + d.getDay();
            var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
            return (date + " | " + time);
        }
    };

    $(function () {

        return new Messages();
    });
});

function getMessages() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        }
    });
    $.ajax({
        type: "POST",
        url: '/messages/update',
        data: {conv_id: $('input[name="conv_id"]').val()},
        success: function (data) {
            if (data) {
                $('#web-messenger').empty().html(data);
            }

        },
        error: function (status) {

        }

    });
}
setInterval(function () {
    getMessages();
}, 10000);

$(document).ready(function () {
    var height = $(window).innerHeight();
    $('#web-messenger').css({
        minHeight: height - 302,
        maxHeight: height - 302
    });
    scroll();

    $('.message-thread-group').css({
        maxHeight : height - 228
    });
})

function scroll() {
    $('#web-messenger').animate({
        scrollTop: $('#web-messenger').prop("scrollHeight")
    }, 0);
}
