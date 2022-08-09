@extends('header_footer')

@section('content')
    <div class="container-fluid" style="padding:20px 30px 20px 30px">
        <h2 class="text-white text-center">Welcome To BeeVerse!</h2>

        <div class="d-flex align-items-center" style="margin-top:30px;">
            <h6 class="text-white" style="margin:0">Filter by Gender: </h6>
            <select id="gender_filter" class="form-select" style="margin-left:10px">
                <option value="">All</option>
                <option value="Male" @if (request()->gender != null && request()->gender == 'Male') selected @endif>Male</option>
                <option value="Female" @if (request()->gender != null && request()->gender == 'Female') selected @endif>Female</option>
            </select>
        </div>

        <div class="row" style="margin-top:20px">
            @foreach ($user as $item)
            <?php
                $hobby = $item->hobbies   
            ?>
            <div class="col-4 d-flex justify-content-center" style="margin: 0px 0px 30px 0px">
                <a href="/user/{{$item->id}}" style="text-decoration:none">
                    <div class="card user-box" style="width: 18rem;">
                        <img class="card-img-top" src="{{$hobby[0]->photo}}" alt="Card image cap" style="max-height:150px;object-fit: cover;">
                        <div class="card-body" style="background-color:var(--dark);">
                            <h5 class="card-title text-white">{{$item->name}}</h5>
                            <p class="card-text text-white">
                                Hobby: @foreach($hobby as $hobby) <span style="background-color: #2a27db;padding:5px;border-radius:5px">{{$hobby->hobby}}</span> @endforeach
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="container d-flex justify-content-center">
            {{ $user->links() }}
        </div>
    </div>
@endsection
