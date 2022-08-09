@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px 0px 0px 25px" href="/">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back
        </div>
    </a>
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
                <form action="/sendFriendReq" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ request()->id }}">
                    <button type="submit" class="btn btn-success">
                        <div class="d-flex align-items-center">
                            <ion-icon name="person-add-outline"></ion-icon>
                            <span style="margin-left:5px">
                                Send Friend Request
                            </span>
                        </div>
                    </button>
                </form>
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
                    <form action="/cancelFriendReq" method="post">
                        @csrf
                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                        <input type="hidden" name="msg" value="Canceled">
                        <div class="d-flex justify-content-center" style="margin-top:20px">
                            <button type="submit" class="btn btn-secondary">
                                <div class="d-flex align-items-center">
                                    <ion-icon name="close-circle-outline"></ion-icon>
                                    <span style="margin-left:5px">
                                        Cancel Friend Request
                                    </span>
                                </div>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="d-flex align-items-center flex-column" style="margin-top:20px">
                        <span class="text-white">This user sent you a friend request!</span>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <form action="/acceptFriendReq" method="post">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <input type="hidden" name="user_id" value="{{ request()->id }}">
                                <button type="submit" class="btn btn-success">
                                    <div class="d-flex align-items-center">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                        <span style="margin-left:5px">
                                            Accept Friend Request
                                        </span>
                                    </div>
                                </button>
                            </form>
                            <form action="/cancelFriendReq" method="post">
                                @csrf
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <input type="hidden" name="msg" value="Rejected">
                                <button type="submit" class="btn btn-danger">
                                    <div class="d-flex align-items-center">
                                        <ion-icon name="close-circle-outline"></ion-icon>
                                        <span style="margin-left:5px">
                                            Reject Friend Request
                                        </span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        @endif
        <div style="margin-top:50px">
            <h5 class="text-white">About Me</h5>
            <hr style="background-color:white;border: 0.5px solid white">
            <table class="table table-bordered" style="background-color: white">
                <tbody>
                  <tr>
                    <th scope="row" style="width: 20%">Name</th>
                    <td style="width: 30%">{{$user->name}}</td>
                    <th scope="row" style="width: 20%">Email</th>
                    <td>{{$user->email}}</td>
                  </tr>
                  <tr>
                    <th scope="row">Gender</th>
                    <td>{{$user->gender}}</td>
                    <th scope="row">Age</th>
                    <td>{{$user->age}} years old</td>
                  </tr>
                  <tr>
                    <th scope="row">Phone Number</th>
                    <td>{{$user->phone}}</td>
                    <th scope="row">Instagram</th>
                    <?php
                    $ig = explode('/', $user->instagram_link);
                    $key = key(array_slice($ig, -1, 1, true));
                    ?>
                    <td><a href="{{$user->instagram_link}}">{{$ig[$key]}}</a></td>
                  </tr>
                  <tr>
                    <th scope="row">Address</th>
                    <td colspan="3">{{$user->address}}</td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div style="margin-top:50px;margin-bottom:70px">
            <h5 class="text-white">My Hobbies</h5>
            <hr style="background-color:white;border: 0.5px solid white">
            <div class="row" style="margin-top:30px">
                @foreach ($user->hobbies as $item)
                    <div class="col-6 d-flex justify-content-start" style="margin-bottom:20px">
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
