var LOADED_QS = 0;
jQuery(document).ready(function () {
    transferLivepData();
});

var NORMAL_FETCH_INTERVAL   = 5000;
var LONGER_FETCH_INTERVAL   = 60000;
var fetchRequestInterval    = 0;
var fetchIntervalId         = 0;

setFetchIntervalId(NORMAL_FETCH_INTERVAL);

function setFetchIntervalId(requestInterval) {

    // If the request timer interval is not changed then do nothing
    if (requestInterval == fetchRequestInterval) {
        return;
    }

    if (fetchIntervalId !== 'undefined') {
        clearInterval(fetchIntervalId);
    }

    // Set the global var to the new value
    fetchRequestInterval = requestInterval;

    fetchIntervalId = setInterval(function() {
        if (typeof theWebinarId !== 'undefined') {
            transferLivepData();
        }
    }, fetchRequestInterval);
}

function transferLivepData() {
    if (typeof theWebinarId === "undefined")
        return;

    var data_ob = {
        action: 'transferLivepData',
        webinar_id: theWebinarId,
        webinar_st: theWebinarstatus,
        last_qid: LOADED_QS,
    };
    jQuery.ajax({
        url: wpws_ajaxurl,
        data: data_ob,
        dataType: 'json',
        type: 'POST',
        success: function (response) {

            // Get online count
            jQuery('#webinar-live-viewers').html(response.data.online_attendees.count);
            // End of get online count

            // Incentive status.
            incentiveStatusChange(response.data.incentive_stauts.isShow);
            // End of incentive status;

            // Set Questions
            setQuestionbox(response.data.questions);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Errors handled.
        }
    });
}

function incentiveStatusChange(isShow) {
    if (isShow === true) {
        jQuery('#show_incentive').show();
        jQuery('#gift_icon').css('color', '#ff002c');
        jQuery('#data_show_incentive').val('');
    } else {
        jQuery('#show_incentive').hide();
        jQuery('#gift_icon').css('color', ' #4c4c4c');
        jQuery('#data_show_incentive').val('yes');
    }
}

var theSaveQuestionButton;
var theSaveQuestionButtonVal;
jQuery(document).on('click', '#saveQuestion', function (e) {
	e.preventDefault();
    var ques_name = jQuery('#que_name').val();
    var ques_email = jQuery('#que_email').val();
    var quest = jQuery('#addQuestion').val();
    if (ques_email.length < 3 || !validateEmail(ques_email) || ques_name.length < 1 || quest.length < 1) {
        alert(questionFormerror);
        return false;
    }

    var datas = {'action': 'saveQuestionAjax', 'question': quest, 'name': jQuery('#que_name').val(),
        'email': jQuery('#que_email').val(), 'webinar_id': theWebinarId};
    theSaveQuestionButton = jQuery(this);
    theSaveQuestionButtonVal = theSaveQuestionButton.val();
    jQuery(this).val(questionWait);
    jQuery(this).attr('disabled', 'disabled');
    jQuery.ajax({type: 'POST', data: datas, url: wpws_ajaxurl, dataType: 'json'
    }).done(function (data) {
        jQuery('#myQuestions').show();
        theSaveQuestionButton.val(theSaveQuestionButtonVal);
        theSaveQuestionButton.removeAttr('disabled');
        jQuery('#addQuestion').val('');
        addQuestionToPage("" + data.question, "" + data.time);
    });
    //e.preventDefault();
});
function addQuestionToPage(question, time) {
    jQuery('#ques_load').prepend(jQuery('<p class="myquestion"><span>' + time + '</span>' + question + '</p>').hide().fadeIn(2000));
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function update_incentive() {
    jQuery.ajax({
        type: 'POST',
        url: wpws_ajaxurl,
        data: {
            'action': 'updateIncentive',
            'post_id': theWebinarId,
            'status': theWebinarstatus
        },
        success: function (data, textStatus, jqXHR) {
            stopAnimation();
        }
    });
}

jQuery(document).on('click', '#gift_icon', function () {
    startAnimation(jQuery(this).attr('id'));
    gift_icons();
});

function gift_icons() {
    var data_show_incentive = jQuery('#data_show_incentive').val();
    if (data_show_incentive == 'yes') {
        incentiveStatusChange(true);
        update_incentive();
    } else {
        incentiveStatusChange(false);
        update_incentive();
    }
}

function setQuestionbox(data) {
    if (data.text.length > 0) {
        if (LOADED_QS === 0)
            jQuery('#webinar_no_messages').empty();
        LOADED_QS = data.id;
        jQuery.each(data.text.reverse(), function (i, q) {
            var n = jQuery('#webinar_no_messages .wswebinar-message').length,
                    seperatorClass = n % 2 === 1 ? 'message-row' : '';

            jQuery('#webinar_no_messages').prepend('<div class="wswebinar-message ' + seperatorClass + '"><strong>' + q.name + '</strong>: ' + q.question + '</div><br>');
            jQuery('#wswebinar_open_msg_cntr').addClass('message-center-newmsg');
        });
    }
    showQuestionbox(data.show_questionbox);
}

function showQuestionbox(isShow) {
    jQuery('#wswebinar-live-page-ask-question-form')[isShow ? 'slideDown' : 'slideUp']();
    if (isShow) {
        jQuery('#webinar_show_questionbox').addClass('message-center-newmsg');
    } else {
        jQuery('#webinar_show_questionbox').removeClass('message-center-newmsg');
    }
}

jQuery(document).on('click', '#webinar_show_questionbox', function (event) {
    event.preventDefault();
    jQuery(this).toggleClass('message-center-newmsg');
    var active = jQuery(this).hasClass('message-center-newmsg');
    startAnimation(jQuery(this).attr('id'));
    showQuestionbox(active);
    jQuery.ajax({
        type: 'POST',
        data: {active: active, action: 'toggleLivePageAskQuestionForm', webinar_id: wbnId},
        url: wpws_ajaxurl,
        success: function (data, textStatus, jqXHR) {
            stopAnimation();
        }
    });
});

function startAnimation(anchorID) {
    var classes_to_remove = [];
    jQuery("#" + anchorID).removeClass(function (index, classNames) {
        var current_classes = classNames.split(" ");
        jQuery.each(current_classes, function (index, class_name) {
            if (!class_name.indexOf('fa') | !class_name.indexOf('glyphicon')) {
                classes_to_remove.push(class_name);
            }
        });
    });
    var animImg = "<img id='adminbar_loader' data-iconclass='" + classes_to_remove.join(" ") + "' class='loading_img_adminbar' data-parent='" + anchorID + "' src='" + loadingImg + "'>";
    var anchorElement = jQuery("#" + anchorID);
    anchorElement.html(animImg);
    jQuery("#" + anchorID).removeClass(classes_to_remove.join(" "));
    return classes_to_remove.join(" ");
}
function stopAnimation() {
    var parent = jQuery('#adminbar_loader').attr('data-parent');
    var clases = jQuery('#adminbar_loader').attr('data-iconclass');
    jQuery('#adminbar_loader').remove();
    jQuery('#' + parent).addClass(clases);
}

jQuery(function () {
    jQuery('[data-toggle="tooltip"]').tooltip();
});