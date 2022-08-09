@extends('header_footer')

@section('content')
    <div class="container" style="margin-top:50px">
        <h4 class="text-white">Avatars</h4>
        <hr style="background-color:white;border: 0.5px solid white">
        {{-- @dump($avatars) --}}

        <div class="alert alert-info" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <strong>@lang('avatar.balance'): <span id="coin"
                        class="{{ Auth::user()->coin == 0 ? 'text-danger' : '' }}">{{ Auth::user()->coin }}</span>
                    @lang('avatar.coin')</strong>
                <a class="btn btn-success" href="/topup">
                    <div class="d-flex align-items-center">
                        <ion-icon name="card" style="margin-right:5px"></ion-icon>
                        Top Up
                    </div>
                </a>
            </div>
        </div>

        <div class="d-flex flex-wrap justify-content-between" style="margin: 10px 0px 30px 0px">
            @foreach ($avatars as $item)
                <div class="d-flex flex-column align-items-center avatar-container" style="padding:20px;">
                    <img src="{{ $item->image }}" alt="" class="img-thumbnail"
                        style="border-radius: 50%;width:175px;height:175px">
                    <strong class="text-white" style="margin-top:10px;">{{ $item->name }}</strong>
                    <span class="text-white" style="margin-bottom:10px"> {{ $item->price }} @lang('avatar.coin')</span>
                    <div class="d-flex justify-content-between btn-group">

                        {{-- @dump($item) --}}
                        @if ($item->user_id == null)
                            <form action="/buyAvatar" method="post">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $item->id }}" />
                                <button type="submit" class="btn btn-primary">
                                    <div class="d-flex align-items-center">
                                        <ion-icon name="cart-outline" style="margin-right:5px"></ion-icon> @lang('avatar.buy')
                                    </div>
                                </button>
                            </form>
                        @else
                            <form action="/useAvatar" method="post">
                                @csrf
                                <input type="hidden" name="avatar_id" value="{{ $item->id }}" />
                                <button type="submit" class="btn btn-success"
                                    {{ $item->id == Auth::user()->avatar->id ? 'disabled' : '' }}>
                                    <div class="d-flex align-items-center">
                                        <ion-icon name="person-circle" style="margin-right:5px"></ion-icon>
                                        {{ $item->id == Auth::user()->avatar->id ? Lang::get('used') : Lang::get('use') }}
                                    </div>
                                </button>
                            </form>
                        @endif
                        <a class="btn btn-warning" href="/giveAvatar/{{ $item->id }}">
                            <div class="d-flex align-items-center">
                                <ion-icon name="gift-outline" style="margin-right:5px"></ion-icon> @lang('avatar.gift')
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $avatars->links() }}
        </div>
    </div>
@endsection
