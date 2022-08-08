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
            loadMessage();
        },
    });
}

function loadMessage(){
    let room_id = $("#room_id").val();
    $.ajax({
        type: "GET",
        url: '/loadMessage',
        data: {room_id: room_id },
        success: function (data) {
            $("#chatbox").html(''); //reset
            data.data.forEach(e=> {
                console.log(e);
                let html = 
                `<div class="container" style="width:100%;background-color:#fff8f8">
                   ${e.message} - ${e.created_at}
                </div>`

                $("#chatbox").append(html);
            });
        },
    });
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    loadMessage();
    setInterval(function () {loadMessage()}, 1000);

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
