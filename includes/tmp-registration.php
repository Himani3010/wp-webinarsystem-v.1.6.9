<?php
defined('ABSPATH') or die(__("No script kiddies please!"));
global $post;

setup_postdata($post);
WebinarSysteem::setPostData($post->ID);

$regp_bckg_clr = get_post_meta($post->ID, '_wswebinar_regp_bckg_clr', true);
$regp_bckg_img = get_post_meta($post->ID, '_wswebinar_regp_bckg_img', true);
$regp_ctatext = get_post_meta($post->ID, '_wswebinar_regp_ctatext', true);
$reg_form_title = get_post_meta($post->ID, '_wswebinar_regp_regformtitle', true);
$reg_form_text = get_post_meta($post->ID, '_wswebinar_regp_regformtxt', true);
$regp_tabbg_clr = get_post_meta($post->ID, '_wswebinar_regp_tabbg_clr', true);
$regp_tabtext_clr = get_post_meta($post->ID, '_wswebinar_regp_tabtext_clr', true);
$regp_tabone_text = get_post_meta($post->ID, '_wswebinar_regp_tabone_text', true);
$regp_tabtwo_text = get_post_meta($post->ID, '_wswebinar_regp_tabtwo_text', true);
$regp_regformfont_clr = get_post_meta($post->ID, '_wswebinar_regp_regformfont_clr', true);
$regp_regformbckg_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbckg_clr', true);
$regp_regformborder_clr = get_post_meta($post->ID, '_wswebinar_regp_regformborder_clr', true);
$regp_regformbtntxt_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtntxt_clr', true);
$regp_regformbtn_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtn_clr', true);
$regp_regformbtnborder_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtnborder_clr', true);
$regp_regtitle_clr = get_post_meta($post->ID, '_wswebinar_regp_regtitle_clr', true);
$reg_login_form_title = get_post_meta($post->ID, '_wswebinar_regp_loginformtitle', true);
$reg_login_form_text = get_post_meta($post->ID, '_wswebinar_regp_loginformtxt', true);
$reg_loginformbtn_clr = get_post_meta($post->ID, '_wswebinar_regp_loginformbtn_clr', true);
$reg_loginformbtnborder_clr = get_post_meta($post->ID, '_wswebinar_regp_loginformbtnborder_clr', true);
$reg_loginformbtntxt_clr = get_post_meta($post->ID, '_wswebinar_regp_loginformbtntxt_clr', true);
$reg_loginctatext = get_post_meta($post->ID, '_wswebinar_regp_loginctatext', true);
$regp_regmeta_clr = get_post_meta($post->ID, '_wswebinar_regp_regmeta_clr', true);
$regp_wbndesc_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndesc_clr', true);
$regp_wbndescbck_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndescbck_clr', true);
$regp_wbndescborder_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndescborder_clr', true);
$registration_disabled = get_post_meta($post->ID, '_wswebinar_gener_regdisabled_yn', true);
$registration_autoplay = get_post_meta($post->ID, '_wswebinar_regp_video_auto_play_yn', true);
$registration_controls = get_post_meta($post->ID, '_wswebinar_regp_video_controls_yn', true);

$reg_formImgVidType = get_post_meta($post->ID, '_wswebinar_regp_vidurl_type', true);
$reg_formImgVidUrl = get_post_meta($post->ID, '_wswebinar_regp_vidurl', true);
$reg_formImgDefUrl = plugins_url('/images/womancaffeelaptopkl.jpg', __FILE__);

$the_regp_tabonetext = !empty($regp_tabone_text) ? $regp_tabone_text : 'Register';
$the_regp_tabtwotext = !empty($regp_tabtwo_text) ? $regp_tabtwo_text : 'Login';

$the_reg_form_title = !empty($reg_form_title) ? $reg_form_title : 'Free Sign Up:';
$the_reg_form_text = !empty($reg_form_text) ? $reg_form_text : '';
$the_regp_ctatext = !empty($regp_ctatext) ? $regp_ctatext : 'Sign Up';
$the_regp_regformfont_clr = !empty($regp_regformfont_clr) ? 'color:' . $regp_regformfont_clr . ' !important;' : '';
$the_regp_regformbckg_clr = !empty($regp_regformbckg_clr) ? 'background-color:' . $regp_regformbckg_clr . ' !important;' : '';
$the_regp_regformborder_clr = !empty($regp_regformborder_clr) ? 'border-color:' . $regp_regformborder_clr . ' !important;' : '';
$the_regp_regformbtntxt_clr = !empty($regp_regformbtntxt_clr) ? 'color:' . $regp_regformbtntxt_clr . ' !important;' : '';
$the_regp_regformbtn_clr = !empty($regp_regformbtn_clr) ? 'background-color:' . $regp_regformbtn_clr . ' !important;' : '';
$the_regp_regformbtnborder_clr = !empty($regp_regformbtnborder_clr) ? 'border-color:' . $regp_regformbtnborder_clr . ' !important;' : '';
$the_login_form_title = !empty($reg_login_form_title) ? $reg_login_form_title : 'Login Here';
$the_login_form_text = !empty($reg_login_form_text) ? $reg_login_form_text : '';
$the_login_btnbg_color = !empty($reg_loginformbtn_clr) ? 'background-color:' . $reg_loginformbtn_clr . ';' : '';
$the_login_btnbrdr_color = !empty($reg_loginformbtnborder_clr) ? 'border-color:' . $reg_loginformbtnborder_clr . ';' : '';
$the_login_btn_color = !empty($reg_loginformbtntxt_clr) ? 'color:' . $reg_loginformbtntxt_clr . ';' : '';
$the_login_btn_text = !empty($reg_loginctatext) ? $reg_loginctatext : 'Login';
$the_regp_regtitle_clr = !empty($regp_regtitle_clr) ? $regp_regtitle_clr : '#C7C7C7';
$the_regp_regmeta_clr = !empty($regp_regmeta_clr) ? $regp_regmeta_clr : '#C7C7C7';
$the_regp_wbndesc_clr = !empty($regp_wbndesc_clr) ? $regp_wbndesc_clr : '#C7C7C7';
$the_regp_wbndescbck_clr = !empty($regp_wbndescbck_clr) ? $regp_wbndescbck_clr : '#000';
$the_regp_wbndescborder_clr = !empty($regp_wbndescborder_clr) ? $regp_wbndescborder_clr : '#C7C7C7';

$the_regp_show_contentbox = get_post_meta($post->ID, '_wswebinar_regp_show_content_setion', true);
$the_regp_description_show = get_post_meta($post->ID , '_wswebinar_regp_show_description' ,true);
$the_regp_form_position = get_post_meta($post->ID , '_wswebinar_regp_position' ,true);
$the_regp_form_position = (empty($the_regp_form_position) ? 'left' : $the_regp_form_position);
$the_regp_form_position = (empty($the_regp_show_contentbox) && empty($the_regp_description_show) ? 'right' : $the_regp_form_position );

$ticketp_font_clr = get_post_meta($post->ID, '_wswebinar_ticketp_font_clr', true);
$ticketp_formbckg_clr = get_post_meta($post->ID, '_wswebinar_ticketp_bckg_clr', true);
$ticketp_formborder_clr = get_post_meta($post->ID, '_wswebinar_ticketp_border_clr', true);

$the_ticketp_font_clr = !empty($ticketp_font_clr) ? 'color:' . $ticketp_font_clr . ' !important;' : '';
$the_ticketp_bckg_clr = !empty($ticketp_formbckg_clr) ? 'background-color:' . $ticketp_formbckg_clr . ' !important;' : '';
$the_ticketp_border_clr = !empty($ticketp_formborder_clr) ? 'border-color:' . $ticketp_formborder_clr . ' !important;' : '';
$wp_paidWebinar = get_post_meta($post->ID, '_wswebinar_ticket_wbnpaid_yn', true) == 'on';
$wp_ticketId = get_post_meta($post->ID, '_wswebinar_ticket_id', true);
$cameFromWebinarRegistration = (isset($_GET['utm_source']) && $_GET['utm_source'] >= 846554 && $_GET['utm_source'] <= 999999999) && isset($_GET['mapdoi']);
$cameFromWebinarTicketPurchase = (isset($_GET['opt']) && $_GET['opt'] >= 95127 && $_GET['opt'] <= 999999999) && isset($_GET['mapdoi']) && isset($_GET['auth']);
$isAdmin = current_user_can('manage_options');
$timeabbr=get_post_meta($post->ID, '_wswebinar_timezoneidentifier', true);
$wpoffset=get_option('gmt_offset');
$gmt_offset=WebinarSysteem::formatTimezone( ( $wpoffset > 0) ? '+'.$wpoffset : $wpoffset );
$timeZone='('. ( (!empty($timeabbr)) ? WebinarSysteem::getTimezoneAbbreviation($timeabbr) : 'UTC '.$gmt_offset ) . ') ';

$timeabbr = get_post_meta($post->ID, '_wswebinar_timezoneidentifier', true);
$wpoffset = get_option('gmt_offset');
$gmt_offset = WebinarSysteem::formatTimezone(( $wpoffset > 0) ? '+' . $wpoffset : $wpoffset );
$timeZone = '(' . ( (!empty($timeabbr)) ? WebinarSysteem::getTimezoneAbbreviation($timeabbr) : 'UTC ' . $gmt_offset ) . ') ';

$dateFormat = get_option('date_format');
$timeFormat = get_option('time_format');

$wb_time = '';
$wb_date = '';
$sv_time = get_post_meta($post->ID, '_wswebinar_gener_time', true);
if (!empty($sv_time)) {
    $wb_time = date_i18n($timeFormat, $sv_time);
    $wb_date = date_i18n($dateFormat, $sv_time);
}
$wb_host = esc_attr(get_post_meta($post->ID, '_wswebinar_hostmetabox_hostname', true));
$wb_hostcount = WebinarSysteemHosts::hostCount($post->ID);

$autoplay = empty($registration_autoplay) ? 0 : 1;
$controls = empty($registration_controls) ? 0 : 1;
?>
<html>
    <head>
        <title><?php echo get_the_title(); ?></title>
        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
        <meta property="og:description" content="<?php echo substr(wp_strip_all_tags(get_the_content(), true), 0, 500); ?>">
        <?php wp_head(); ?>
        <style type="text/css"><?php
            echo (!empty($regp_bckg_clr)) ? '.tmp-main{background-color:' . $regp_bckg_clr . ';}' : '';
            echo (!empty($regp_bckg_img)) ? '.tmp-main{background-image: url(' . $regp_bckg_img . ');}' : '';
            echo ($regp_regformborder_clr) ? '#custom-tabs > li,#custom-tabs > li > a,#custom-tabs > li > a:hover {border-color:' . $regp_regformborder_clr . '}' : '';
            echo ($regp_regformbckg_clr) ? '#custom-tabs li.active > a,#custom-tabs li.active > a:hover,#custom-tabs li.active > a:focus { background: ' . $regp_regformbckg_clr . ' none repeat scroll 0 0;}' : '';
            echo ($regp_regformfont_clr) ? '#custom-tabs li.active > a,#custom-tabs li.active > a:hover,#custom-tabs li.active > a:focus { color: ' . $regp_regformfont_clr . ';}' : '';
            echo ($regp_tabbg_clr) ? '#custom-tabs li > a,#custom-tabs li > a:hover,#custom-tabs li > a:focus { background-color: ' . $regp_tabbg_clr . ';}' : '';
            echo ($regp_tabtext_clr) ? '#custom-tabs li > a,#custom-tabs li > a:hover,#custom-tabs li > a:focus { color: ' . $regp_tabtext_clr . ';}' : '';
            echo ($regp_regformbckg_clr) ? '#custom-tabs li.active > a,#custom-tabs li.active > a:hover,#custom-tabs li.active > a:focus { border-bottom-color: ' . $regp_regformbckg_clr . ';}' : '';
            echo '.reg-content,.reg-content *{background-color:' . $the_regp_wbndescbck_clr . ' !important;border-color:' . $the_regp_wbndescborder_clr . ' !important;color:' . $the_regp_wbndesc_clr . '!important}';
            ?>
	</style>
    </head>
    <body class="tmp-main">
        <div class="container">

            <!--[if lt IE 9]>
                <div style='row'>
                    <div class="col-xs-6 col-xs-offset-2">
                        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">
                          <img src="<?php echo plugins_url('./images/iecheck.jpg', __FILE__); ?>" border="0" height="42" width="820" alt="" />
                        </a>
                    </div>
                </div>
            <![endif]-->

            <div class="row">
                <div class="col-xs-12">
                    <div>
                        <h1 class="text-center" id="reg-title" style="color:<?php echo $the_regp_regtitle_clr ?> !important"><?php the_title(); ?></h1> 
                    </div> 
                    <h4 class="text-center" id="reg-meta" style="color:<?php echo $the_regp_regmeta_clr ?> !important"><?php
                        if (!WebinarSysteem::isRecurring($post->ID)) {
                            echo (!empty($wb_date) ? __('Date', WebinarSysteem::$lang_slug) . ': ' . $wb_date . '  ' : null);
                            echo (!empty($wb_time) ? __('Time', WebinarSysteem::$lang_slug) . ': ' . $wb_time . '  ' : null);
                            echo $timeZone;
                        }
                        echo WebinarSysteemHosts::isMultipleHosts($post->ID) ? '<br/>' : '';
                        echo (!empty($wb_host) ? _n('Host', 'Hosts', $wb_hostcount, WebinarSysteem::$lang_slug) . ': ' . $wb_host : null);
                        ?>
                    </h4>
                </div>
            </div>
            <div class="row" style="margin-top: 40px;">
                <?php if($the_regp_show_contentbox == 'yes' | empty($the_regp_show_contentbox)): ?>
                <div class="col-lg-8 col-sm-8 col-xs-12">
                    <div id="embed">
                        <?php
                        if (!empty($reg_formImgVidType) && !empty($reg_formImgVidUrl)):
                            if ($reg_formImgVidType == 'youtube'):
                                $youtubeid = WebinarSysteem::getYoutubeIdFromUrl($reg_formImgVidUrl);
                                ?>
                                <iframe width="100%" height="563" src="//www.youtube.com/embed/<?php echo $youtubeid; ?>?controls=<?php echo $controls ?>&rel=0&showinfo=0&autoplay=<?php echo $autoplay; ?>" frameborder="0" allowfullscreen></iframe>
                            <?php elseif ($reg_formImgVidType == 'vimeo'): ?>
                                <iframe src="https://player.vimeo.com/video/<?php echo $reg_formImgVidUrl .'?autoplay='. $autoplay ?>" width="100%" height="563" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <?php else: ?>
                                <img src="<?php echo $reg_formImgVidUrl; ?>" width="100%" height="315">
                            <?php
                            endif;
                        else:
                            ?> <img src="<?php echo $reg_formImgDefUrl; ?>" width="100%" height="315" />
                        <?php endif;
                        ?>
                    </div>
                </div>
                <?php endif; ?>
                
                    <?php if($the_regp_form_position == 'right' | $the_regp_form_position == 'left'){ ?>
                        <div class="col-lg-4 col-sm-4 col-xs-12 
                     <?php if($the_regp_form_position == 'right'){ echo 'pull-right'; }else if($the_regp_form_position == 'left'){ echo 'pull-left'; } ?> ">
                    
                    <?php }else{ ?>                                
                            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12"></div> 
                            <div class="col-lg-4 col-md-4 col-sm-6  col-xs-12">
                    <?php } ?>
                    
                    <?php if (empty($registration_disabled)) { ?>
                        <ul class="nav nav-tabs" id="custom-tabs">
                            <li class="<?php echo (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd') ? '' : 'active'; ?>"><a href="javascript:;"><?php echo $the_regp_tabonetext; ?></a></li>
                            <li class="<?php echo (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd') ? 'active' : ''; ?>"><a href="javascript:;"><?php echo $the_regp_tabtwotext; ?></a></li>
                        </ul>
                        <div class="content-wraper">
                            <div class="tab-content text-center round-border signup <?php echo (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd') ? 'hide' : ''; ?>" style="<?php echo $the_regp_regformbckg_clr . $the_regp_regformfont_clr . $the_regp_regformborder_clr; ?>">
                                <h3><?php echo $the_reg_form_title; ?></h3>
                                <p><?php echo $the_reg_form_text; ?></p>
                                <div>
                                    <form method="POST">
                                        <input type="hidden" name="webinarRegForm" value="submit">
                                        <input type="hidden" name="webinarTab" value="register">
                                        <input class="form-control forminputs" name="inputname" placeholder="<?php _e('Your Name', WebinarSysteem::$lang_slug) ?>" type="text" value="<?php echo!empty($_REQUEST['inputname']) ? $_REQUEST['inputname'] : ''; ?>" />
                                        <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputname'): ?>
                                            <span class="error"><?php _e('Please enter your name.', WebinarSysteem::$lang_slug) ?></span>
                                        <?php endif; ?>
                                        <input class="form-control forminputs" name="inputemail" placeholder="<?php _e('Your Email Address', WebinarSysteem::$lang_slug) ?>" type="email" value="<?php echo!empty($_REQUEST['inputemail']) ? $_REQUEST['inputemail'] : ''; ?>" />
                                        <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputemail'): ?>
                                            <span class="error"><?php _e('Please enter your email.', WebinarSysteem::$lang_slug) ?></span>
                                        <?php endif; ?>
                                        <?php
                                        if (WebinarSysteem::isRecurring($post->ID)):
                                            $recurr_instances = WebinarSysteem::getRecurringInstances($post->ID);
                                            ?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <select class="form-control forminputs" name="inputday">
                                                        <option disabled="disabled" selected="selected">Select a day</option>
                                                        <?php
                                                        foreach ($recurr_instances['days'] as $day_item) {
                                                            echo "<option value='$day_item'>" . WebinarSysteemMetabox::getWeekDayArray($day_item) . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputday'): ?>
                                                        <span class="error"><?php _e('Select a day to watch.', WebinarSysteem::$lang_slug) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control forminputs" name="inputtime">
                                                        <option disabled="disabled" selected="selected">Select a time</option>
                                                        <?php
                                                        foreach ($recurr_instances['times'] as $time) {
                                                            echo '<option value="' . $time . '">' . date('h:i A', strtotime($time)) . " " . $timeZone . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputtime'): ?>
                                                        <span class="error"><?php _e('Select a time to watch.', WebinarSysteem::$lang_slug) ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <button class="btn btn-success forminputs" style=" <?php echo $the_regp_regformbtn_clr . $the_regp_regformbtntxt_clr . $the_regp_regformbtnborder_clr; ?>" type="submit"><?php echo $the_regp_ctatext; ?></button>
                                    </form>
                                    <p><?php _e('Of course we will handle your data safely.', WebinarSysteem::$lang_slug) ?></p>
                                </div>
                            </div>
                            <div class="tab-content text-center round-border login <?php echo (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd') ? '' : 'hide'; ?>" style="<?php echo $the_regp_regformbckg_clr . $the_regp_regformfont_clr . $the_regp_regformborder_clr; ?>">
                                <h3><?php echo $the_login_form_title; ?></h3>
                                <p><?php echo $the_login_form_text; ?></p>
                                <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd'): ?>
                                    <span class="error">This email is not registered.</span>
                                <?php endif; ?>
                                <div>
                                    <form method="POST">
                                        <input type="hidden" name="webinarRegForm" value="submit">
                                        <input type="hidden" name="webinarTab" value="login">
                                        <input class="form-control forminputs" name="inputemail" placeholder="<?php _e('Your Email Address', WebinarSysteem::$lang_slug) ?>" type="email" value="<?php echo!empty($_REQUEST['inputemail']) ? $_REQUEST['inputemail'] : ''; ?>" />
                                        <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputemail'): ?>
                                            <span class="error"><?php _e('Please enter your email.', WebinarSysteem::$lang_slug) ?></span>
                                        <?php endif; ?>
                                        <button class="btn btn-success forminputs" style=" <?php echo $the_login_btnbg_color . $the_login_btnbrdr_color . $the_login_btn_color; ?>" type="submit"><?php echo $the_login_btn_text; ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?> 
                        <div class="text-center round-border-full signup" style="<?php echo $the_regp_regformbckg_clr . $the_regp_regformfont_clr . $the_regp_regformborder_clr; ?>">
                            <h1><?php _e('Registration is closed for this webinar.', WebinarSysteem::$lang_slug) ?></h1>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            $t_cont = get_the_content();
            if (!empty($t_cont) & $the_regp_description_show == 'yes'):
                ?>
                <div class="row">
                    <div id="WebinarDescription" class="col-xs-12">
                        <div class="round-border footer reg-content"><?php echo apply_filters('the_content',$t_cont); ?></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>