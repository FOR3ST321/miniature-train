@extends('header_footer')

@section('content')
    <div class="container" style="margin-top:50px">
        {{-- @dump($avatars) --}}

        <div class="card text-center">
            <div class="card-header">
                PAY REGISTRATION
            </div>
            <div class="card-body">
                <h5 class="card-title"> Please Pay the registration fee to continue</h5>
                <img src="/img/tobrut.png" alt="topup" style="height:350px;width:350px">
                <form action="/payRegist/{{request()->id}}" method="POST">
                    @csrf
                    <div class="d-flex flex-column align-items-center" style="margin-bottom:20px;margin-top:20px">
                        <h5>Registration Fee: <span id="regist_price">{{$user->regist_price}}</span></h5>
                        <input id="regist_fee" type="number" name="amount" class="form-control" style="width: 30%" placeholder="Insert Your Payment" autofocus>
                        <span id="notif_regist"></span>
                    </div>
                    <button id="regist_pay_button" type="submit" class="btn btn-primary" style="width:30%" disabled>
                        <div class="d-flex align-items-center justify-content-center">
                            <ion-icon name="wallet" style="margin-right: 5px"></ion-icon>
                            <span id="regis_payment_btnTxt">Pay</span>
                        </div>
                    </button>
                </form>
                <button type="submit" class="btn btn-danger" style="width:30%;margin-top:10px;" id="regis_noBtn">
                    <div class="d-flex align-items-center justify-content-center">
                        No
                    </div>
                </button>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
@endsection
