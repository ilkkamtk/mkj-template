'use strict';

jQuery('#like-form').on('submit', function (evt) {
    evt.preventDefault();
    const data = jQuery(this).serialize();
    console.log(data);
    jQuery.post(like_button.ajax_url, data, function (response) {
        console.log(response);
        jQuery('#like-count').text(response.likes);
        jQuery('ion-icon').attr('name', response.liked ? 'heart-dislike' : 'heart');
    });
});