@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px" href="/avatar">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back
        </div>
    </a>
    <div class="container" style="margin-top:10px">
        <h3 class="text-white text-center">Give Avatar</h3>
        <div class="d-flex justify-content-center">
            <img class="img-thumbnail" style="margin-top:20px;width:300px;height:300px;border-radius:50%"
                src="{{ $avatar->image }}" alt="">
        </div>
        <form action="/giveAvatar" method="post">
            @csrf
            <input type="hidden" name="avatar_id" value="{{ request()->id }}"/>
            <div class="d-flex flex-column align-items-center" style="margin-top:20px">
                <strong class="text-white">Give Avatar To:</strong>
                <select name="friend" id="" class="form-control" style="width:40%">
                    @foreach ($friendList as $friend)
                        <?php
                        $row = $friend->friend_1 == Auth::user()->id ? $friend->friends_2 : $friend->friends_1;
                        ?>
                        {{-- @dump($row) --}}
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" style="width:40%;margin-top:20px">Give Avatar!</button>
            </div>
        </form>
    </div>
@endsection
