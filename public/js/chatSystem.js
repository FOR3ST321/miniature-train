function sendChat() {
    let msg = $("#chat_input").val();
    let room_id = $("#room_id").val();
    let url = $("#chatForm").data('url');
    // console.log(url)
    $.ajax({
        type: "POST",
        url: url,
        data: {message: msg, room_id: room_id },
        success: function (data) {
            $("#chat_input").val('');
        },
    });
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#send_button").attr("disabled", "true");
    $("#send_button").click(function (e) {
        e.preventDefault();
        sendChat();
    });

    $("#chat_input").keypress(function (e) {
        if ($(this).val().length > 0) {
            $("#send_button").removeAttr("disabled");

            let key = e.which;
            if (key == 13) {
                //enter key
                e.preventDefault();
                sendChat();
            }
        } else {
            $("#send_button").attr("disabled", "true");
        }
    });
});
