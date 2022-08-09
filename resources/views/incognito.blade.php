@extends('header_footer')

@section('content')
    <a class="btn btn-outline-danger text-white" style="margin:20px 0px 0px 25px" href="/profile">
        <div class="d-flex align-items-center">
            <ion-icon name="chevron-back-outline"></ion-icon> Back
        </div>
    </a>
    <div class="container" style="margin-top:20px">
        {{-- @dump($avatars) --}}

        <div class="card text-center">
            <div class="card-header">
                <h4>INCOGNITO MODE</h4>
            </div>
            <div class="card-body">
                <h5 class="card-title"> Your Status: {{Auth::user()->is_incognito ? 'INCOGNITO' : 'Normal'}} </h5>
                <img src="/img/incognito.png" alt="topup" style="height:350px;width:350px">
                @if (!Auth::user()->is_incognito)
                    <h5>Switch to incognito for 50 coins!</h5>
                @else
                    <h5>Switch back to normal for 5 coins!</h5>
                @endif
                <p>Your Balance: {{Auth::user()->coin}} coin(s)</p>
                
                <form action="/switchIncognito" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width:30%">
                        <div class="d-flex align-items-center justify-content-center">
                            <ion-icon name="eye-off" style="margin-right:5px"></ion-icon>
                            Switch
                        </div>
                    </button>
                </form>
            </div>
            <div class="card-footer text-muted">
                
            </div>
        </div>
    </div>
@endsection
