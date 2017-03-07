/*Custom register/login tabs*/
/* global wbnId, wpws_ajaxurl, admin */

jQuery(document).on('click', '#custom-tabs li a', function ()
{
    /*Remove active*/
    jQuery('#custom-tabs li').removeClass('active');
    jQuery('.content-wraper .tab-content').addClass('hide');

    /*add active*/
    jQuery(this).parent('li').addClass('active');
    jQuery('.content-wraper .tab-content:eq(' + jQuery(this).parent('li').index() + ')').removeClass('hide');
});

/*
 * 
 * Header bar
 * 
 */
jQuery(document).ready(function ($) {
    var loadedQ = 0;
    $('#wswebinar_private_que').hide().show().hide();
    $('#wswebinar_open_msg_cntr').click(function (e) {
        $(this).toggleClass('message-center-active').removeClass('message-center-newmsg');
        $('#wswebinar_private_que').toggle();
        e.stopPropagation();
    });
    $('#wswebinar_private_que').mousemove(function () {
        $('#wswebinar_open_msg_cntr').removeClass('message-center-newmsg');
    });
    $(document).click(function (e) {
        if (!$(e.target).is('#wswebinar_private_que, #wswebinar_private_que *')) {
            $('#wswebinar_open_msg_cntr').removeClass('message-center-active')
            $("#wswebinar_private_que").hide();
        }
    });
    
    //    Remove Monarch plugin Styles
        jQuery("[class^='et_']").hide();
});
