jQuery(document).ready(function($) {
    "use strict";
    //page Sidebars
    $('input[name="mom_page_layout"]').click( function() {
        if ($(this).val() === 'full') {
            $('#mom_custom_sidebar').parent().parent().slideUp();
        } else {
            $('#mom_custom_sidebar').parent().parent().slideDown();
        }
    });

        if ($('input[name="mom_page_layout"]:checked').val() === 'full') {
            $('#mom_custom_sidebar').parent().parent().slideUp();
        } else {
            $('#mom_custom_sidebar').parent().parent().slideDown();
        }
});