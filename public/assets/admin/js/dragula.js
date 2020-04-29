(function ($) {
    'use strict';
    var iconTochange;
    var relatedImage;
    dragula([document.getElementById("dragula-left"), document.getElementById("dragula-right")]);
    dragula([document.getElementById("profile-list-left"), document.getElementById("profile-list-right")]);
    dragula([document.getElementById("dragula-event-left"), document.getElementById("dragula-event-right")])
        .on('drop', function (el) {
            iconTochange = $(el).find('.fa');
            relatedImage = $(el).find('.related_image');
            let divId = $(el).closest('.parentDiv').attr('id');
            if (divId === 'dragula-event-right') {
                iconTochange.removeClass('text-primary').addClass('text-danger');
                relatedImage.attr('name', 'removeImage[]');
            } else {
                relatedImage.removeClass('active');
                relatedImage.attr('name', '');
                iconTochange.removeClass('text-danger').addClass('text-success');
            }
        })

    dragula([document.getElementById("dragula-event-left-collection"), document.getElementById("dragula-event-right-collection")])
        .on('drop', function (el) {
            iconTochange = $(el).find('.fa');
            relatedImage = $(el).find('.related_collection');
            let divId = $(el).closest('.parentDiv').attr('id');
            if (divId === 'dragula-event-right-collection') {
                iconTochange.removeClass('text-primary').addClass('text-danger');
                relatedImage.attr('name', 'removeCollection[]');

            } else {
                relatedImage.removeClass('active');
                relatedImage.attr('name', '');
                iconTochange.removeClass('text-danger').addClass('text-success');
            }

        })
})(jQuery);
