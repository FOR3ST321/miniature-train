//php yg nerima ajax ada di web.php, cek aja ada "ajax" nya

function sendChat() {
    //ambil message, room id, sama url aku taro di <form> , tapi kalau pake cara tembak url kaya loadMessage() harusnya bisa, coba aja :D
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
    let room_id = $("#room_id").val(); //ambil room id dari input hidden
    $.ajax({
        type: "GET",
        url: '/loadMessage',
        data: {room_id: room_id },
        success: function (data) { 
            $("#chatbox").html(''); //reset
            data.data.forEach(e=> { //loop data yg diterima dari function php
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
            scrollToBottom(); //ini kalau panjang jadi auto scroll ke bawah, tapi ngebug kalau kita coba scroll ke atas
        },
    });
}

function scrollToBottom(){
    const element = document.getElementById('chatbox');
    element.scrollTop = element.scrollHeight;
}

$(document).ready(function () { //mulai dari sini

    //setup ajax wajib, jangan lupa liat di header_footer ditambah meta csrf, terus include jquery nya harud cdn ajax
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //load message
    loadMessage();
    
    //setiap 1 detik manggil ajax buat refresh message baru
    setInterval(function () {loadMessage()}, 1000);

    $("#send_button").attr("disabled", "true"); //disable button send dari awal jadi gak ngirim input kosong
    $("#send_button").click(function (e) {
        e.preventDefault();
        sendChat(); //kalau send dipencet, kirim chat
    });

    $("#chat_input").keypress(function (e) { //ini cek di input kalau kita ngetik
        if ($(this).val().length > 0) { //kalau gak kosong
            $("#send_button").removeAttr("disabled"); //enable button send

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
