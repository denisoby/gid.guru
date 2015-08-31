jQuery(document).ready(function($) {
    "use strict";
    $('#post-formats-select input[name="post_format"]').change( function() {
        var val = $(this).val();
      if (val === 'aside') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_aside_st').fadeIn();
       } else if (val === 'status') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_status_st').fadeIn();
       } else if (val === 'chat') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_chat_st').fadeIn();
       } else {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .posts_extra_empty').fadeIn();
       }
    });
    var val = $('#post-formats-select input[name="post_format"]:checked').val();
      if (val === 'aside') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_aside_st').fadeIn();
       } else if (val === 'status') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_status_st').fadeIn();
       } else if (val === 'chat') {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .pt_chat_st').fadeIn();
       } else {
            $('#mom_posts_extra_metabox .posts_extra_item').fadeOut();
            $('#mom_posts_extra_metabox .posts_extra_empty').fadeIn();
       }

});