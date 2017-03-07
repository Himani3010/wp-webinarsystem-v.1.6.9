<?php

class WebinarSysteemShortCodes {

    function __construct() {
	add_shortcode('webinarsystem_registration', array($this, 'registration'));
	add_shortcode('webinarsystem_login', array($this, 'login'));

	add_filter('mce_buttons', array($this, 'register_tinymce_buttons'));
	add_filter('mce_external_plugins', array($this, 'register_tinymce_javascript'));

	add_action('admin_footer', array($this, 'shortcodeData'));
    }

    function registration($attributes) {
	$attrs = shortcode_atts(array(
	    'id' => "no_post_id",
	    'button' => NULL,
	    'url' => NULL,
		), $attributes);

	ob_start();
	if (get_post_status($attrs['id']) === FALSE)
	    return __('Error: ') . __('Invalid webinar id.', WebinarSysteem::$lang_slug);

	$postId = $attrs['id'];
	$url = $attrs['url'];

	if (!empty($_GET['_wswebinarsystem_newly_registered' . $postId]) && $_GET['_wswebinarsystem_newly_registered' . $postId]):
	    ?>
	    <span class="success"><?php printf(__('You\'ve successfully registered for %s', WebinarSysteem::$lang_slug), get_the_title($postId)) ?></span>
	    <?php
	    $content = ob_get_clean();
	    return $content;
	endif;

	if (!empty($_GET['_wswebinarsystem_already_registered' . $postId]) && $_GET['_wswebinarsystem_already_registered' . $postId]):
	    ?>
	    <span class="success"><?php printf(__('You\'re already registered for %s', WebinarSysteem::$lang_slug), get_the_title($postId)) ?></span>
	    <?php
	    $content = ob_get_clean();
	    return $content;
	endif;

	$registration_disabled = get_post_meta($postId, '_wswebinar_gener_regdisabled_yn', true);

	if (!empty($registration_disabled)) {
	    ?>
	    <div class="text-center round-border-full signup">
	        <h1><?php _e('Registration is closed for this webinar.', WebinarSysteem::$lang_slug) ?></h1>
	    </div>
	    <?php
	    $content = ob_get_clean();
	    return $content;
	}
        $meta_btn_txt = get_post_meta($attrs['id'], '_wswebinar_regp_ctatext', true);
        $registerButtonText = (!empty($attrs['button']) ? $attrs['button'] : (!empty($meta_btn_txt) ? $meta_btn_txt : 'Sign Up') );
        ?>

	<form method="POST">
	    <input type="hidden" name="webinarRegForm" value="submit">
	    <?php if ($url) { ?>
	        <input type="hidden" name="redirectAfter" value="<?php echo $url ?>">
	    <?php } ?>
	    <input type="hidden" name="webinarTab" value="register">
	    <input type="hidden" name="wbnid" value="<?php echo $postId ?>">
	    <input class="form-control forminputs wswebinarsys-registration-name-input" name="inputname" placeholder="<?php _e('Your Name', WebinarSysteem::$lang_slug) ?>" type="text" value="<?php echo!empty($_REQUEST['inputname']) ? $_REQUEST['inputname'] : ''; ?>" />
	    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputname'): ?>
	        <span class="error"><?php _e('Please enter your name.', WebinarSysteem::$lang_slug) ?></span>
	    <?php endif; ?>
	    <input class="form-control forminputs wswebinarsys-registration-email-input" name="inputemail" placeholder="<?php _e('Your Email Address', WebinarSysteem::$lang_slug) ?>" type="email" value="<?php echo!empty($_REQUEST['inputemail']) ? $_REQUEST['inputemail'] : ''; ?>" />
	    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputemail'): ?>
	        <span class="error"><?php _e('Please enter your email.', WebinarSysteem::$lang_slug) ?></span>
	    <?php endif; ?>
	    <?php
	    if (WebinarSysteem::isRecurring($postId)):
		$recurr_instances = WebinarSysteem::getRecurringInstances($postId);
		?>
	        <div class="row">
	    	<div class="col-sm-12">
	    	    <select class="form-control forminputs wswebinarsys-registration-day-select" name="inputday">
	    		<option disabled selected>Select a day</option>
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
	    	    <select class="form-control forminputs wswebinarsys-registration-time-select" name="inputtime">
	    		<option disabled selected>Select a time</option>
			    <?php
			    $metaval = get_post_meta($post->ID, '_wswebinar_gener_timeslot_count', true);
			    $timeslot_count = (empty($metaval) ? 100 : $metaval);
			    $showing_count = 0;

			    foreach ($recurr_instances['times'] as $time) {
				if ($showing_count < $timeslot_count) {
				    if ($time != 'rightnow') {
					echo '<option value="' . date('H:i', $time) . '">' . date('H:i', $time) . " " . $timeZone . '</option>';
				    }
				    $showing_count++;
				}
			    }
			    ?>
	    	    </select>
			<?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputtime'): ?>
			    <span class="error"><?php _e('Select a time to watch.', WebinarSysteem::$lang_slug) ?></span>
			<?php endif; ?>
	    	</div>
	        </div>
	    <?php endif; ?>
	    <button class="forminputs wswebinarsys-registration-submit-btn" type="submit"><?php echo $registerButtonText; ?></button>
	</form>
	<?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd'): ?>
	    <span class="error">This email is not registered.</span>
	    <?php
	endif;
	$content = ob_get_clean();
	return $content;
    }

    function login($attributes) {
	$attrs = shortcode_atts(array(
	    'id' => "no_post_id",
            'button' => NULL
		), $attributes);

	ob_start();

	if (get_post_status($attrs['id']) === FALSE) {
	    __('Error: ') . __('Invalid webinar id.', WebinarSysteem::$lang_slug);
	    $content = ob_get_clean();
	    return $content;
	}
        $postId = $attrs['id'];
        $metaLoginButtonText = get_post_meta($postId, '_wswebinar_regp_loginctatext', true);
	$loginButtonText = (!empty($attrs['button']) ? $attrs['button'] : (!empty($metaLoginButtonText) ? $metaLoginButtonText : 'Login') );
	?>
	<form method="POST">
	    <input type="hidden" name="webinarRegForm" value="submit">
	    <input type="hidden" name="webinarTab" value="login">
	    <input type="hidden" name="wbnid" value="<?php echo $postId ?>">
	    <input class="form-control forminputs wswebinarsys-login-email-input" name="inputemail" placeholder="<?php _e('Your Email Address', WebinarSysteem::$lang_slug) ?>" type="email" value="<?php echo!empty($_REQUEST['inputemail']) ? $_REQUEST['inputemail'] : ''; ?>" />
	    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputemail'): ?>
	        <span class="error"><?php _e('Please enter your email.', WebinarSysteem::$lang_slug) ?></span>
	    <?php endif; ?>
	    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'notregisterd'): ?>
	        <span class="error"><?php _e('Please register before login.', WebinarSysteem::$lang_slug) ?></span>
	    <?php endif; ?>
	    <button class="forminputs wswebinarsys-login-submit-btn" type="submit"><?php echo $loginButtonText; ?></button>
	</form>
	<?php
	$content = ob_get_clean();
	return $content;
    }

    /**
     * Add buttons to tiny
     * 
     * @param array $buttons
     * @return array
     */
    function register_tinymce_buttons($buttons) {
	array_push($buttons, 'separator', 'login_register_shortcodes');
	return $buttons;
    }

    function register_tinymce_javascript($plugin_array) {
	$plugin_array['wpwebinarsystem'] = plugins_url('/js/tinymce-custom.js', __FILE__);
	return $plugin_array;
    }

    function shortcodeData() {
	global $post;
	query_posts(array('post_type' => 'wswebinars', 'orderby' => 'date'));
	?>
	<script type="text/javascript">
	    var wpwebinarsystem_shortcode_data = [[
	<?php
	if (have_posts()) {
	    while (have_posts()) {
		the_post();
		?>
		    {text: '<?php echo html_entity_decode(get_the_title()) ?>', onclick: function () {
		    tinyMCE.activeEditor.insertContent('[webinarsystem_registration id="<?php echo $post->ID ?>" url="" button=""] ');
		    }},
		<?php
	    }
	}
	?>
	    ], [
	<?php
	if (have_posts()) {
	    while (have_posts()) {
		the_post();
		?>
		    {text: '<?php echo html_entity_decode(get_the_title()) ?>', onclick: function () {
		    tinyMCE.activeEditor.insertContent('[webinarsystem_login id="<?php echo $post->ID ?>" button=""] ');
		    }},
		<?php
	    }
	}
	?>
	    ]];
	</script>
	<?php
	wp_reset_query();
    }

}
