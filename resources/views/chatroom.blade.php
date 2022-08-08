@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px" href="/message">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back to Message
        </div>
    </a>

    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="container" style="width:60vw;padding:20px;border:2px solid white;min-height:20vh">
            <div class="d-flex align-items-center">
                <img src="/img/avatar/1.png" alt="" class="img-thumbnail"
                    style="width: 75px;height:75px;border-radius:50%">
                <h4 class="text-white" style="margin-left:20px">Lorem</h4>
            </div>
            <hr style="border:1px solid white">

            <div class="d-flex align-items-center text-white" style="margin:20px 0px 20px 0px">
                Chat - waktu
            </div>

            <form id='chatForm' data-url={{ route('sendMessage') }} method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="hidden" id="room_id" value="{{ request()->id }}">
                    <input type="text" class="form-control" placeholder="Type Message..." id="chat_input" />
                    <button class="btn btn-outline-primary" type="button" id="send_button">
                        <ion-icon name="send-outline"></ion-icon>
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection