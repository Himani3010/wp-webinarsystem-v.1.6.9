<?php
/**
 * Description of class-webinarsysteemviews
 */
class WebinarSysteemViews {

    static function get_livepage_data($post, $status) {
        $page = ($status == 'live' || $status == 'liv') ? 'livep_' : 'replayp_';
        setup_postdata($post);
        WebinarSysteem::setPostData($post->ID);
        return array(
            'data_title_show_yn' => get_post_meta($post->ID, '_wswebinar_' . $page . 'title_show_yn', true),
            'data_title_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'title_clr', true),
            'data_backg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'bckg_clr', true),
            'data_backg_img' => get_post_meta($post->ID, '_wswebinar_' . $page . 'bckg_img', true),
            'data_imgvid_type' => get_post_meta($post->ID, '_wswebinar_' . $page . 'vidurl_type', true),
            'data_imgvid_url' => get_post_meta($post->ID, '_wswebinar_' . $page . 'vidurl', true),
            'data_show_presenter' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_yn', true),
            'data_show_desc' => get_post_meta($post->ID, '_wswebinar_' . $page . 'webdes_yn', true),
            'data_livep_show_ques' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_yn', true),
            'data_show_incentive' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_yn', true),
            'data_defImgUrl' => plugins_url('/images/clapper.jpg', __FILE__),
            'data_hostnames' => WebinarSysteemHosts::getHostsArray($post->ID),
            'data_hostcount' => WebinarSysteemHosts::hostCount($post->ID),
            'data_autoplay' => get_post_meta($post->ID, '_wswebinar_' . $page . 'video_auto_play_yn', true),
            'data_controls' => get_post_meta($post->ID, '_wswebinar_' . $page . 'video_controls_yn', true),
            'data_askq_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_title_text_clr', true),
            'data_livep_askq_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_bckg_clr', true),
            'data_livep_leftbox_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'leftbox_bckg_clr', true),
            'data_livep_descbox_title_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_title_bckg_clr', true),
            'data_livep_descbox_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_title_text_clr', true),
            'data_livep_descbox_content_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_content_text_clr', true),
            'data_livep_hostbox_title_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_title_bckg_clr', true),
            'data_livep_hostbox_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_title_text_clr', true),
            'data_livep_hostbox_content_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_content_text_clr', true),
            'data_livep_incentive_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_bckg_clr', true),
            'data_livep_incentive_title_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_title_clr', true),
            'data_livep_incentive_title_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_title_bckg_clr', true),
            'data_livep_button_bg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'button_bg_clr', true),
            'data_livep_buttonhover_bg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'buttonhover_bg_clr', true),
            'data_livep_button_border_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'button_border_clr', true),
            'data_livep_buttonhover_border_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'buttonhover_border_clr', true),
            'data_livep_button_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'button_text_clr', true),
            'data_livep_buttonhover_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'buttonhover_text_clr', true),
            'data_livep_button_radius' => get_post_meta($post->ID, '_wswebinar_' . $page . 'button_radius', true),
            'data_livep_incentive_title' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_title', true),
            'data_livep_incentive_content' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_content', true),
            'data_livep_incentive_txtclr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_content_clr', true), 
            'data_page_show_quebox' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_yn', true),
            'page_status' => $page,
        );
    }

    static function get_header_bar($class_WebinarSysteem) {
        if (!is_a($class_WebinarSysteem, 'WebinarSysteem'))
            return;
        $webinar_id = get_the_ID();
        $webinar_status = get_post_meta($webinar_id, '_wswebinar_gener_webinar_status', true);
        $show_questionbox = ($webinar_status == 'liv' ? get_post_meta($webinar_id, '_wswebinar_livep_askq_yn', true) : get_post_meta($webinar_id, '_wswebinar_replayp_askq_yn', true) );
        ?>
        <div id="webinar-actionbar">
            <ul>
                <li>
                    <a href="#" class="icon webi-class-play disable-hover"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
            </ul>
            <ul class="webinar-admin-chatico">
                <li class="tooltip-livep cusrsor-pointer" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php _e('Question Box',  WebinarSysteem::$lang_slug); ?>" >
                    <a id="webinar_show_questionbox" data-webinarid="131" class="icon fa fa-question <?php echo !empty($show_questionbox) ? 'message-center-newmsg' : '' ?>" style="cursor: pointer; font-size: 18px; padding-top: 8px; margin-top: 0px;"></a>
                </li>
                <li class="tooltip-livep cusrsor-pointer" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php _e('Incentive Box',  WebinarSysteem::$lang_slug); ?>">
                    <a href="javascript:void(0)" class="glyphicon glyphicon-gift" id="gift_icon" style="padding-top: 9px;top: 0;"></a>
                </li>
                <li class="tooltip-livep cusrsor-pointer" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php _e('Message Center',  WebinarSysteem::$lang_slug); ?>" >
                    <a id="wswebinar_open_msg_cntr" class="icon webi-class-comments webinar-message-center"></a>
                    <ul id="wswebinar_private_que" class="display-block">
                        <div id="webinar_no_messages" class="webinar_privcht_system">
                            <div class="wswebinar-message"><strong>System Bot</strong>: No messages to show</div><br>
                        </div>
                    </ul>
                </li>
            </ul>
            <ul class="right-column">
                <li>
                    <a href="#" class="">
                        <span id="webinar-live-viewers-icon"></span>
                        <span id="webinar-live-viewers">0</span>
                    </a>
                    <ul id="attendee-online-list">
                    </ul>
                </li>
                <li>
                    <a href="#" class="disable-hover">Status : <span class='status-text'><?php echo $class_WebinarSysteem->getWebinarStatusText(get_the_ID()); ?></span></a>
                </li>
            </ul>
        </div>
        <?php
    }

}
