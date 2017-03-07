<?php

class WebinarSysteemQuestions extends WebinarSysteem {

    protected static $db_questions_tablename ='wswebinars_questions';
    function __construct() {
        $this->setAttributes();
    }

    /*
     * 
     * Questions view page.
     * 
     */

    public function showPage() {
        $webs = $this->getWebinarList();
        $webinar_id = @$webs[0]->ID;
        if (!empty($_GET['webinar_id']))
            $webinar_id = (int) $_GET['webinar_id'];
        ?>
        <div class="wrap wswebinarwrap">
            <div class="wswebinarLogo">
                <img src="<?php echo plugins_url('images/WebinarSysteem-logo.png', __FILE__); ?>" />
            </div>
            <div style="clear: both"></div>
            <h2><?php _e('WP WebinarSystem Questions', WebinarSysteem::$lang_slug); ?></h2>
            <p><?php _e('Select webinar to view questions for active webinars', WebinarSysteem::$lang_slug); ?></p>
            <div class="tablenav top">
                <div class="alignleft">
                    <form method="get">
                        <input type="hidden" name="post_type" value="wswebinars">
                        <input type="hidden" name="page" value="wswbn-questions">
                        <select name="webinar_id">
                            <?php
                            if (!empty($webinar_id) && $webinar_id > 0) {
                                foreach ($webs as $web):
                                    echo '<option value="' . $web->ID . '"' . ($webinar_id == $web->ID ? "selected" : "") . '>' . $web->post_title . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                        <input class="button" type="submit" value="Select">
                    </form>
                    <?php //echo var_dump();  ?>
                </div>
                <div class="alignright">
                    <button type="button" class="button" id="delete_selected_questions"><?php _e("Delete Selected", WebinarSysteem::$lang_slug); ?></button>
                    <button type="button" class="button" id="export_selected_questions" data-webinarid="<?php echo $webinar_id; ?>"><?php _e('Export CSV', WebinarSysteem::$lang_slug); ?></button>
                    <button type="button" class="button" id="export_selected_quest_bcc" data-webinarid="<?php echo $webinar_id; ?>"><?php _e('Export TEXT', WebinarSysteem::$lang_slug); ?> </button>
                </div>
            </div>
            <table class="wp-list-table widefat fixed posts">
                <thead>
                    <?php
                    echo $header__s = '<tr><th class="column-title wswebinarquestion_checkbox"><input type="checkbox" class="select_all_questions"></th><th class="column-title wsquestionid">#</th><th class="column-title wsquestionname">' . __('Name', WebinarSysteem::$lang_slug) . '</th><th class="column-title" style="width: 58%;">' . __('Question', WebinarSysteem::$lang_slug) . '</th><th class="column-title wsquestiontime">' . __('Time', WebinarSysteem::$lang_slug) . '</th></tr>';
                    ?>
                </thead>
                <tfoot>
                    <?php echo $header__s; ?>
                </tfoot>
                <tbody id="loadQuestions">
                    <?php
                    if (!empty($webinar_id) && $webinar_id > 0) {
                        $res = $this->getQuestionsFromDb($webinar_id);
                        echo $res['string'];
                        $loadedQues = $res['last_id'];
                    }
                    ?>
                </tbody>
            </table>
            <input type="hidden" id="loadedQues" value="<?php echo $loadedQues; ?>">
            <input type="hidden" id="webinar_id" value="<?php echo $webinar_id; ?>">
        </div>
        <?php
    }

    /*
     * 
     * Handles the Ajax request of the questions page.
     * 
     */

    public static function retrieveQuestions($webinar_id,$last_id,$getAsObject,$orderByDESC) {
        $ret = self::getQuestionsFromDb($webinar_id, $last_id, $getAsObject, $orderByDESC);
        $status = count($ret['num_of_rows']) > 0;
        $webinar_stauts = get_post_meta($webinar_id, '_wswebinar_gener_webinar_status', true);
    $meta_name = ($webinar_stauts == 'liv' || $webinar_stauts == 'live' ? '_wswebinar_livep_askq_yn' : '_wswebinar_replayp_askq_yn');
        $show_questionbox = get_post_meta($webinar_id, $meta_name, true);
        return array(
            'status' => $status,
            'text' => $ret['string'],
            'id' => $ret['last_id'],
            'show_questionbox' => $show_questionbox == 'yes'
        );
    }

    /*
     * 
     * Create the <tr> elements for the questions page.
     * 
     */

    public static function getQuestionsFromDb($webinar_id, $last_id = NULL, $getAsObject = FALSE, $orderByDESC = TRUE) {
        global $wpdb;
        $order = $orderByDESC ? "DESC" : "ASC";
        $table = $wpdb->prefix . self::$db_questions_tablename;
        $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id";
        if (!empty($last_id))
            $query.=" AND id > $last_id";
        $query.=" ORDER BY id $order";
        $savedQues = $wpdb->get_results($query);
        $ret = $getAsObject ? array() : '';
        //$ret.= '<span>';
        foreach ($savedQues as $que):

            if ($getAsObject) {
                $ret[] = array('id' => $que->id, 'email' => $que->email, 'name' => $que->name, 'question' => $que->question, 'time' => date("Y/m/d H:i A", strtotime($que->time)));
                continue;
            }

            $ret.= '<tr>';
            $ret.= '<td><input type="checkbox" class="column-title select_question_slice" data-qid="' . $que->id . '"></td>';
            $ret.= "<td class='wsquestionid'>$que->id</td>";
            $ret.= "<td class='wsquestionname'><a href='mailto:$que->email' target='_blank'>$que->name</a></td>";
            $ret.= "<td class='wsquestion'>$que->question</td>";
            $ret.= "<td class='wsquestiontime'>" . date("Y/m/d H:i A", strtotime($que->time)) . "</td>";
            $ret.= '</tr>';
        endforeach;
        $lastid = 0;
        if (!empty($savedQues[0]->id)) {
            $lastid = $savedQues[0]->id;
        } elseif (!empty($last_id)) {
            $lastid = $last_id;
        }
        //$ret.= '</span>';
        return array('string' => $ret, 'last_id' => $lastid, 'num_of_rows' => count($savedQues));
    }

    private function getWebinarList() {
        $args = array(
            'orderby' => 'post_date',
            'order' => 'DESC',
            //'meta_key'         => '',
            //'meta_value'       => '',
            'post_type' => 'wswebinars',
            'post_status' => 'publish',
            'suppress_filters' => true,
            'posts_per_page' => -1);

        $webs = get_posts($args);
        return $webs;
    }

    public function dropQuestions() {
        $rtrn = array('error' => false);
        $webs = $this->getWebinarList();
        $webinar_id = @$webs[0]->ID;
        if (!empty($webinar_id) && $webinar_id > 0) {
            $qid_array = $_POST['questions'];
            if (isset($qid_array) && !empty($qid_array)) {
                global $wpdb;
                foreach ($qid_array as $question) {
                    $process = $wpdb->delete(WSWEB_DB_TABLE_PREFIX . 'questions', array('id' => ((int) $question)));
                    if (!$process) {
                        $rtrn['error'] = true;
                    }
                }
            }
        } else {
            $rtrn['error'] = true;
        }
        echo json_encode($rtrn);
        wp_die();
    }

    public static function exportQuestionsAsCSV() {
        if (!isset($_GET['wswebinar_create_questions_csv']) | !isset($_GET['webinar_id']))
            return false;
        $webinar_id = $_GET["webinar_id"];
        $webinar_system = new WebinarSysteem();
        global $wpdb;
        $table = $wpdb->prefix . $webinar_system->db_tablename_questions;
        $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id ORDER BY id DESC";
        $savedQues = $wpdb->get_results($query);
        $getTitle = get_the_title($webinar_id);
        $posttitle = !empty($getTitle) ? $getTitle : 'Unknown';
        $csvTitle = 'webinarsysteem_question_' . WebinarSysteemAttendees::adjustAndGetTitleForFileNames($posttitle) . '_' . time() . '.csv';
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $csvTitle . '";');
        $csvArray = array();
        $csvArray[] = array('Name', 'Email', 'Question', 'Asked on');
        foreach ($savedQues as $que):
            $csvArray[] = array($que->name, $que->email, $que->question, $que->time);
        endforeach;
        WebinarSysteemAttendees::convertToCsv($csvArray, $csvTitle, ',');
        exit();
    }

    public static function exportQuestionsAsBCC() {
        if (!isset($_GET['wswebinar_create_questions_bcc']) | !isset($_GET["webinar_id"])):
            return false;
        else:
            @$webinar_id = $_GET["webinar_id"];
            $regs = WebinarSysteemAttendees::getAttendies(@$webinar_id);


            $webinar_system = new WebinarSysteem();
            global $wpdb;
            $table = $wpdb->prefix . $webinar_system->db_tablename_questions;
            $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id ORDER BY id DESC";
            $savedQues = $wpdb->get_results($query);
            $getTitle = get_the_title($webinar_id);
            $posttitle = !empty($getTitle) ? $getTitle : 'Unknown';

            $textTitle = 'webinarsysteem_questionsbcc_' . WebinarSysteemAttendees::adjustAndGetTitleForFileNames($posttitle) . '_' . time() . '.txt';

            header('Content-type: text/plain; charset=utf-8');
            header('Content-Disposition: attachement; filename="' . $textTitle . '";');

            foreach ($savedQues as $que):
                echo $que->id . ' - ' . $que->name . ' - ' . $que->email . ' - ' . $que->question . ' - ' . $que->time . PHP_EOL;
            endforeach;
        endif;
        exit();
    }

    public function toggleLivePageAskQuestionForm() {
        if (empty($_POST['webinar_id']) && empty($_POST['active']))
            wp_die();
        $meta_val = $_POST['active'] == 'true' ? 'yes' : '';
        $webinar_status = get_post_meta($_POST['webinar_id'], '_wswebinar_gener_webinar_status', true);
        if($webinar_status == 'liv' || $webinar_status == 'live'){
            update_post_meta($_POST['webinar_id'], '_wswebinar_livep_askq_yn', $meta_val);
        }else{
            update_post_meta($_POST['webinar_id'], '_wswebinar_replayp_askq_yn', $meta_val);
        }
        echo json_encode(array('success' => TRUE, 'new_val' => $meta_val));
        wp_die();
    }

}
