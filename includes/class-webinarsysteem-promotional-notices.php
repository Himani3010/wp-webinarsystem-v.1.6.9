<?php

/**
 * Description of WebinarSysteemPromotionalNotices
 * Show notices for seasonal pro-plugin promotions.
 * 
 * 
 */
class WebinarSysteemPromotionalNotices {

    public static $notice_slug = "ws-notice-";

    /**
     * Created for Valentine.
     * 
     * Will be displayed till 1st of February to 16th of February 2016 only to NEW USERS.
     */
    static function valentine() {
        $user_id = get_current_user_id();
        $meta = get_user_meta($user_id, self::$notice_slug . 'valentine17', true);
        $rightTime = time() < strtotime("18 Feb 2017");
        if (!empty($meta) || !$rightTime)
            return;
        $current_user = wp_get_current_user();
        add_user_meta($user_id, self::$notice_slug . 'valentine17', NULL, true);
        ?>
        <div class="ws-notice">
            <div class="notice-image-container">
                <img src="<?php echo plugins_url('./images/webinarbot-valentine-hearteyes.png', __FILE__) ?>" height="100">
            </div>
            <div class="notice-text">
                <?php _e("Hey <strong>$current_user->display_name</strong>, thank you for using my plugin. Want more functionalities like automated, recurring, member and paid webinars? Then download <strong>WP WebinarSystem Pro during this Valentine's celebration with 30% off!</strong> This special offer is only for you as an user of this Lite version of WP WebinarSystem.<br>Use coupon <strong>lovewebinarbot17</strong> during checkout, which is valid until 17th of February 2017.<br>Love, Webinarbot", WebinarSysteem::$lang_slug); ?>
            </div>
            <div class="notice-button-container">
                <a class="button button-primary" href="http://www.wpwebinarsystem.com/pricing/?utm_source=liteversion&utm_medium=topnotification&utm_content=valentine2017&utm_campaign=valentine2017" target="_blank"><?php _e('Yes, download Pro!', WebinarSysteem::$lang_slug) ?></a><br/>
                <div class="welcome-panel-close" data-notice-slug="valentine17">
                    Dismiss
                </div>
            </div>
        </div>
        <?php
    }

    static function footerRating() {

        printf(__('If you like <strong>WP WebinarSystem</strong> please leave us a %s rating. A huge thank you in advance!', WebinarSysteem::$lang_slug), '<a href="https://wordpress.org/support/view/plugin-reviews/wp-webinarsystem?filter=5#postform" target="_blank">★★★★★</a>');
    }

    /**
     * Ajax call to dismiss a given notice
     * 
     */
    static function dismiss() {
        $user_id = get_current_user_id();
        $status = update_user_meta($user_id, self::$notice_slug . $_POST['notice_slug'], true);
        echo json_encode(array('status' => $status));
        wp_die();
    }

}
