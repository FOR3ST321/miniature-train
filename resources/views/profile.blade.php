@extends('header_footer')

@section('content')
    <div class="container" style="margin-top:50px;margin-bottom:50px">
        <h3 class="text-white text-center">{{ $user->name }}</h3>
        <div class="d-flex justify-content-center" style="margin-top:20px">
            <img src="{{Auth::user()->is_incognito? Auth::user()->incognito_bear : Auth::user()->avatar->image}}" alt="avatar" style="width: 200px;height:200px;border-radius:50%"
                class="img-thumbnail">

        </div>
           
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
        <div style="margin-top:30px">
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

        <div style="margin-top:30px">
            <h5 class="text-white">My Avatars</h5>
            <hr style="background-color:white;border: 0.5px solid white">
            <a href="/avatar" class="btn btn-primary">Buy More Avatar!</a>
            <div class="d-flex flex-wrap justify-content-between" style="margin: 10px 0px 30px 0px">
                {{-- @dump($myAvatar) --}}
                @foreach ($myAvatar as $item)
                    <div class="d-flex flex-column align-items-center avatar-container" style="padding:20px;">
                        <img src="{{ $item->image }}" alt="" class="img-thumbnail"
                            style="border-radius: 50%;width:175px;height:175px">
                        <strong class="text-white" style="margin-top:10px;margin-bottom:10px">{{ $item->name }} @if ($item->is_a_gift)<ion-icon name="gift"></ion-icon> @endif</strong>
                        <div class="d-flex justify-content-between btn-group">
    
                            {{-- @dump($item) --}}
                            <form action="/useAvatar" method="post">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $item->id }}"/>
                                <button type="submit" class="btn btn-success"
                                    {{ $item->id == Auth::user()->avatar->id ? 'disabled' : '' }}>
                                    <div class="d-flex align-items-center">
                                        <ion-icon name="person-circle" style="margin-right:5px"></ion-icon>
                                        {{ $item->id == Auth::user()->avatar->id ? 'Used' : 'Use' }}
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="margin-top:30px">
            <h5 class="text-white">Settings</h5>
            <hr style="background-color:white;border: 0.5px solid white">
            <a href="/incognito" class="btn btn-warning">Incognito Mode ({{Auth::user()->is_incognito? 'On' : 'Off'}})</a>
            <a href="/logout" class="btn btn-danger">Logout</a>
        </div>
    </div>

    
@endsection
