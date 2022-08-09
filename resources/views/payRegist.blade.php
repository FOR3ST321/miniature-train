@extends('header_footer')

@section('content')
    <div class="container" style="margin-top:50px">
        {{-- @dump($avatars) --}}

        <div class="card text-center">
            <div class="card-header">
                @lang('pay.title')
            </div>
            <div class="card-body">
                <h5 class="card-title">@lang('pay.desc')</h5>
                <img src="/img/tobrut.png" alt="topup" style="height:350px;width:350px">
                <form action="/payRegist/{{request()->id}}" method="POST">
                    @csrf
                    <div class="d-flex flex-column align-items-center" style="margin-bottom:20px;margin-top:20px">
                        <h5>@lang('pay.fee'): <span id="regist_price">{{$user->regist_price}}</span></h5>
                        <input id="regist_fee" type="number" name="amount" class="form-control" style="width: 30%" placeholder="@lang('pay.insert')" autofocus>
                        <span id="notif_regist"></span>
                    </div>
                    <button id="regist_pay_button" type="submit" class="btn btn-primary" style="width:30%" disabled>
                        <div class="d-flex align-items-center justify-content-center">
                            <ion-icon name="wallet" style="margin-right: 5px"></ion-icon>
                            <span id="regis_payment_btnTxt">@lang('pay.pay')</span>
                        </div>
                    </button>
                </form>
                <button type="submit" class="btn btn-danger" style="width:30%;margin-top:10px;" id="regis_noBtn">
                    <div class="d-flex align-items-center justify-content-center">
                        @lang('pay.no')
                    </div>
                </button>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
@endsection
