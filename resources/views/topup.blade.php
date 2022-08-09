@extends('header_footer')

@section('content')
    <div class="container" style="margin-top:50px">
        {{-- @dump($avatars) --}}

        <div class="card text-center">
            <div class="card-header">
                @lang('topup.coin')
            </div>
            <div class="card-body">
                <h5 class="card-title"> @lang('avatar.balance'): <span id="coin"
                        class="{{ Auth::user()->coin == 0 ? 'text-danger' : '' }}">{{ Auth::user()->coin }}</span>
                    @lang('avatar.coin')</h5>
                <img src="/img/tobrut.png" alt="topup" style="height:350px;width:350px">
                <h5>@lang('topup.add')</h5>
                <form action="/topup" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:30%">
                        <div class="d-flex align-items-center justify-content-center">
                            <ion-icon name="wallet" style="margin-right: 5px"></ion-icon>
                            Top Up
                        </div>
                    </button>
                </form>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
@endsection
