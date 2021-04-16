"use strict";

// Class definition
var KTAvatarSingle = function () {
    // Private functions
    var avatar;
    var init = function () {
        avatar = new KTAvatar('kt_avatar_single');
        //var avatar2 = new KTAvatar('kt_user_avatar_2');
        //var avatar3 = new KTAvatar('kt_user_avatar_3');
        //var avatar4 = new KTAvatar('kt_user_avatar_4');
        if($("#kt_avatar_single").attr('data-default-image') !== "undefined") {
            avatar.on('cancel', function (e) {
                if (e.src == $(e.holder).css('background-image') && e.src.indexOf($(e.element).data('default-image')) == -1) {
                    e.src = "url(" + $(e.element).data('default-image') + ")";
                    $('#' + $(e.element).data('delete-input-id')).val(1);
                }
            });
            avatar.on('after-cancel', function (e) {
                if (e.src.indexOf($(e.element).data('default-image')) == -1) {
                    $(e.element).addClass('kt-avatar--changed');
                }
            });
        }
    }

    return {
        // public functions
        init: function() {
            init();
        },
        avatar: function() {
            return avatar;
        }
    };
}();

KTUtil.ready(function() {
    KTAvatarSingle.init();
});
