@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px 0px 0px 25px" href="/">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back to Home
        </div>
    </a>
    <div class="container-fluid" style="padding:20px 30px 20px 30px">
        <h3 class="text-white">Search Result For: {{ request()->searchData }}</h3>

        <div class="row" style="margin-top:20px">
            @foreach ($data as $item)
                <?php
                $hobby = $item->hobbies;
                ?>
                <div class="col-4 d-flex justify-content-center" style="margin: 0px 0px 30px 0px">
                    <a href="/user/{{ $item->id }}" style="text-decoration:none">
                        <div class="card user-box" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $hobby[0]->photo }}" alt="Card image cap"
                                style="max-height:150px;object-fit: cover;">
                            <div class="card-body" style="background-color:var(--dark);">
                                <h5 class="card-title text-white">{{ $item->name }}</h5>
                                <p class="card-text text-white">
                                    Hobby: @foreach ($hobby as $hobby)
                                        <span
                                            style="background-color: #2a27db;padding:5px;border-radius:5px">{{ $hobby->hobby }}</span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="container d-flex justify-content-center">
            {{ $data->links() }}
        </div>
    </div>
@endsection
