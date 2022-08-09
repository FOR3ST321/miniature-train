@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px" href="/message">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back to Message
        </div>
    </a>

    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="container" style="width:60vw;padding:20px;border:2px solid white;min-height:20vh">
            <?php
            $pointer = $room->friends_1->id == Auth::user()->id ? $room->friends_2 : $room->friends_1;
            ?>
            {{-- @dump($room) --}}
            <div class="d-flex align-items-center">
                <img src="{{$pointer->is_incognito? $pointer->incognito_bear : $pointer->avatar->image}}" alt="" class="img-thumbnail"
                    style="width: 75px;height:75px;border-radius:50%">
                <h4 class="text-white" style="margin-left:20px">{{ $pointer->name }}</h4>
            </div>
            <hr style="border:1px solid white">

            <div class="d-flex flex-column" style="margin:20px 0px 20px 0px;max-height:50vh;overflow-y:auto" id="chatbox">

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

    <script src="/js/chatSystem.js"></script>
@endsection
