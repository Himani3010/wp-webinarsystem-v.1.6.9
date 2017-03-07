<?php
if (!isset($_REQUEST['action']))
    die('-1');

$webinarAllowedActions = array (
    'saveQuestionAjax',
    'sendChat',
    'setEnabledChats',
    'setEnabledQuestions',
    'retrieveQuestions',
    'quickchangestatus',
    'previewemails',
    'remove_attendee',
    'checkWebinarStatus',
    'transferLivepData',
    'raiseHand',
    'unraiseHands',
    'syncImportImgs',
    'checkEnomailAPIkey',
    'revokeAweberConfig',
    'checkGetresponse_apikey',
    'updateIncentive',
    'showCTA',
    'hostdescBoxes',
    'actionBoxStatus',
    'deleteChats',
    'deleteQuestions',
    'checkActiveCampaign_apicredentials',
    'newAattendeeCSV',
    'toggleLivePageAskQuestionForm',
	'dismissNotice'
);

// Now test for valid actions.
if (!in_array($_REQUEST['action'], $webinarAllowedActions)) {
    die('-1');
}

//mimic the actuall admin-ajax
define('DOING_AJAX', true);
define('DOING_WEBINAR_AJAX', true);

if (!isset($_REQUEST['action']))
    die('-1');

require_once('../../../../wp-load.php');

//Typical headers
header('Content-Type: text/html');
send_nosniff_header();

//Disable caching
header('Cache-Control: no-cache');
header('Pragma: no-cache');

$action = esc_attr(trim($_REQUEST['action']));

if (is_user_logged_in())
    do_action('wp_ajax_' . $action);
else
    do_action('wp_ajax_nopriv_' . $action);
