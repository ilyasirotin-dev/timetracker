
log_start = function(id, date, isAdmin) {
    $.ajax({
        url: '/log/set/start',
        type: 'post',
        data: {
            'id' : id,
            'day': date,
        },
        success: function(response) {
            if(response !== null) {
                let $selector = '.day_' + date + ' .id_' + id;
                $("<div>", {
                    class: "record_" + response.recordId,
                }).appendTo($selector);
                $("<input>", {
                    class: "start",
                    type: "time",
                    value: response.time,
                    disabled: !isAdmin,
                }).attr('onchange', `update_time(\'start\', ${response.recordId})`).appendTo(".record_" + response.recordId);
                $("<span></span>").text(' - ').appendTo(".record_" + response.recordId);
            }
        },
        error: function () {
            console.log("Log start error");
        }
    });
};

log_stop = function(id, date, isAdmin) {
    $.ajax({
        url: '/log/set/stop',
        type: 'post',
        data: {
            'id' : id,
            'day': date,
        },
        success: function(response) {
            if(response !== null) {
                let $selector = '.day_' + date + ' .id_' + id;
                $("<input>", {
                    class: "end",
                    type: "time",
                    value: response.time,
                    disabled: !isAdmin,
                }).attr('onchange', `update_time(\'end\', ${response.recordId})`).appendTo(".record_" + response.recordId);
                $("<br>").appendTo(".record_" + response.recordId);
            }
        },
        error: function () {
            console.log("Log stop error");
        }
    });
};

update_time = function(log_type, record_id) {
    let new_time = $(".record_" + record_id + " ." + log_type).val();
    $.ajax({
        url: "/log/set/update",
        type: "post",
        data: {
            'type': log_type,
            'recordId': record_id,
            'time' : new_time,
        },
        success: function (response) {
            if(response !== null) {
                window.location.reload();
            }
        },
        error: function () {
            console.log('Update time error');
        },
    });
};
