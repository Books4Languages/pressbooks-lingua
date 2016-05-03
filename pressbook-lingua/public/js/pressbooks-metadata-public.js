jQuery(document).ready(function ($) {
    'use strict';
    $("#lb_discussion_url").after($("#lb_time_required"));
    $("#lb_time_required").after($('#lb_generaldesc'));       
    $('#lb_generaldesc').after($('#lb_desc1'));
    $('#lb_desc1').after($('#lb_desc2'));
    $('#lb_desc2').after($('#lb_video'));
    $('#lb_video').after($('#lb_audio'));
});
