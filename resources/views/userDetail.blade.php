@extends('header_footer')

@section('content')
    <button class="btn btn-outline-danger text-white" style="margin:20px 0px 0px 25px" onclick="history.back()">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back
        </div>
    </button>
    {{-- @dump($friend) --}}

    <div class="container" style="margin-top:20px">
        <h3 class="text-white text-center">{{ $user->name }}</h3>
        <div class="d-flex justify-content-center" style="margin-top:20px">
            <img src="{{ $user->avatar->image }}" alt="avatar" style="width: 200px;height:200px;border-radius:50%"
                class="img-thumbnail">

        </div>

        {{-- friend button --}}
        @if ($friend == null)
            <div class="d-flex justify-content-center" style="margin-top:20px">
                <a href="" class="btn btn-success">
                    <div class="d-flex align-items-center">
                        <ion-icon name="person-add-outline"></ion-icon>
                        <span style="margin-left:5px">
                            Send Friend Request
                        </span>
                    </div>
                </a>
            </div>
        @else
            @if ($friend->is_confirmed)
                <div class="d-flex justify-content-center" style="margin-top:20px">
                    <button class="btn btn-primary" style="cursor:default">
                        <div class="d-flex align-items-center">
                            <span>
                                Friends
                            </span>
                            <ion-icon name="checkmark-circle-outline" style="margin-left:5px"></ion-icon>
                        </div>
                    </button>
                </div>
            @else
                {{-- asumsi friend_1 yang ngirim --}}
                @if ($friend->friend_1 == auth()->user()->id)
                    <div class="d-flex justify-content-center" style="margin-top:20px">
                        <a href="" class="btn btn-secondary">
                            <div class="d-flex align-items-center">
                                <ion-icon name="close-circle-outline"></ion-icon>
                                <span style="margin-left:5px">
                                    Cancel Friend Request
                                </span>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="d-flex align-items-center flex-column" style="margin-top:20px">
                        <span class="text-white">This user sent you a friend request!</span>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="" class="btn btn-success">
                                <div class="d-flex align-items-center">
                                    <ion-icon name="close-circle-outline"></ion-icon>
                                    <span style="margin-left:5px">
                                        Accept Friend Request
                                    </span>
                                </div>
                            </a>
                            <a href="" class="btn btn-danger">
                                <div class="d-flex align-items-center">
                                    <ion-icon name="close-circle-outline"></ion-icon>
                                    <span style="margin-left:5px">
                                        Reject Friend Request
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endif
        @endif
        <div style="margin-top:50px">
            <h5 class="text-white">About Me</h5>
            <hr style="background-color:white;border: 0.5px solid white">

        </div>
        <div style="margin-top:50px;margin-bottom:70px">
            <h5 class="text-white">My Hobbies</h5>
            <hr style="background-color:white;border: 0.5px solid white">
            <div class="row" style="margin-top:30px">
                @foreach ($user->hobbies as $item)
                    <div class="col-6 d-flex justify-content-start">
                        <div class="card" style="width: 18rem;background-color:var(--dark)">
                            <img class="card-img-top" src="{{ $item->photo }}" alt="Card image cap">
                            <div class="card-body text-white">
                                <h5>{{ $item->hobby }}</h5>
                                <p class="card-text" style="font-size:14px">{{ $item->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
