function sendChat() {
    let msg = $("#chat_input").val();
    let room_id = $("#room_id").val();
    let url = $("#chatForm").data('url');
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
            $("#chatbox").html(''); 
            data.data.forEach(e=> { 
                let html;
                if(e.user_id === e.sender){
                    html =  `<div class="container text-white text-right" style="background-color:#2cab20;margin:10px 0px 5px 40%;width:60%;padding:10px">
                    ${e.message}
                    </div>
                    <p class='text-white text-right' style="font-size:12px">${e.created_at}</p>`
                }
                else{
                    html = 
                    `<div class="container text-white" style="background-color:#3a3fde;margin:10px 0px 5px 0px;width:60%;padding:10px">
                    ${e.message}
                    </div>
                    <p class='text-white text-left' style="font-size:12px">${e.created_at}</p>`
                }

                $("#chatbox").append(html);
            });
            scrollToBottom();
        },
    });
}

function scrollToBottom(){
    const element = document.getElementById('chatbox');
    element.scrollTop = element.scrollHeight;
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
                e.preventDefault();
                sendChat();
            }
        } else {
            $("#send_button").attr("disabled", "true");
        }
    });
});
