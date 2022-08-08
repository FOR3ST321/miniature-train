@extends('header_footer')

@section('content')
    <div class="container" style="padding-top:30px">
        <h3 class="text-white">Chats</h3>
        <hr style="border:1px solid white">
        @foreach ($rooms as $item)
            {{-- @dump($item) --}}
            <?php
            $pointer = $item->friends_1->name == Auth::user()->name ? $item->friends_2 : $item->friends_1;
            ?>
            <a href="/chat/{{$item->id}}" style="text-decoration: none">
                <div class="d-flex align-items-center" style="margin:10px 0px 10px 0px">
                    <img src="{{ $pointer->avatar->image }}" alt="" class="img-thumbnail"
                        style="width: 75px;height:75px;margin-top:5px">
                    <h4 class="text-white" style="margin-left:20px">{{ $pointer->name }}</h4>
                </div>
            </a>
        @endforeach
    </div>
@endsection
