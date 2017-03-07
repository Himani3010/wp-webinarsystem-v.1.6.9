<?php

class WebinarSysteemAjax {

    private static function returnError($message = 'Unknown') {
        header('Content-Type:application/json');
        echo json_encode(array('status' => FALSE, 'message' => $message));
        wp_die();
    }

    private static function returnData($data) {
        header('Content-Type:application/json');
        echo json_encode(array('status' => TRUE, 'data' => $data));
        wp_die();
    }

    public static function updateLastSeen($web_id) {
        $attendee = WebinarSysteemAttendees::getAttendee($web_id);
        if (isset($attendee->id) && $attendee->id > 0) {
            if (WebinarSysteemAttendees::modifyAttendee($attendee->id, array('last_seen' => gmdate('Y-m-d H:i:s')), array('%s'))) {
                return TRUE;
            }
        }
        return FALSE;
    }
    public static function updateIncentive() {
        $post_status = $_POST['status'];
        $post_id = $_POST['post_id'];
        if ($post_status == 'live' || $post_status == 'liv') {
            $saved_value = get_post_meta($post_id, '_wswebinar_livep_incentive_yn', true);
            $value = ($saved_value == 'yes' ? '' : 'yes');
            update_post_meta($post_id, '_wswebinar_livep_incentive_yn', $value);
        } else if ($post_status == 'replay' || $post_status == 'rep') {
            $saved_value = get_post_meta($post_id, '_wswebinar_replayp_incentive_yn', true);
            $value = ($saved_value == 'yes' ? '' : 'yes');
            update_post_meta($post_id, '_wswebinar_replayp_incentive_yn', $value);
        }
        wp_die();
    }

    public static function getOnlineCount($webinar_id) {
        global $wpdb;
        $table = WSWEB_DB_TABLE_PREFIX . 'subscribers';
        $query = "SELECT name FROM $table WHERE webinar_id = $webinar_id AND last_seen BETWEEN '" . date('Y-m-d H:i:s', strtotime('-18 seconds')) . "' AND '" . date('Y-m-d H:i:s')."'";
        $data  = $wpdb->get_results($query);
        return array('count' => count($data));
    }
    
    public static function incentiveStatus($post_id, $webinar_status) {
        if ($webinar_status == 'live' || $webinar_status == 'liv') {
            $incentiveStatus = get_post_meta($post_id, '_wswebinar_livep_incentive_yn', true);
            return ($incentiveStatus === 'yes') ? array('isShow' => true) : array('isShow' => false);
        } else if ($webinar_status == 'replay' || $webinar_status == 'rep') {
            $incentiveStatus = get_post_meta($post_id, '_wswebinar_replayp_incentive_yn', true);
            return ($incentiveStatus === 'yes') ? array('isShow' => true) : array('isShow' => false);
        }
    }
    
    public static function transferLivepData() {
        $webinar_id = $_POST['webinar_id'];
        $webinar_status = $_POST['webinar_st'];
        $last_qid = $_POST['last_qid'];

        $return_array = array(
            'last_seen' => true,
            'webinar_id' => 'undefined',
            'online_attendees' => FALSE,
            'incentive_stauts' => FALSE,
            'questions' => FALSE,
            'page' => FALSE
        );
        
        if(!empty($webinar_id)){
            $return_array['webinar_id'] = $webinar_id;
        }
        // Incentive box status
        $return_array['incentive_stauts'] = self::incentiveStatus($webinar_id, $webinar_status);
        
        // Update Lats seen
        $return_array['last_seen'] = self::updateLastSeen($webinar_id);
        
        // Get online attendees.
        $return_array['online_attendees'] = self::getOnlineCount($webinar_id);
        
        $return_array['questions'] = WebinarSysteemQuestions::retrieveQuestions($webinar_id,$last_qid,TRUE,TRUE);

        $return_array['page'] = $webinar_status;

        self::returnData($return_array);
    }

}
