@extends('header_footer')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh">
        <div class="container" style="width:400px;background-color:white;padding:20px">
            <h3 class="text-center">LOGIN</h3>
            <form action="/login" method="post" style="margin-top: 30px">
                @csrf
                @if ($errors->any())
                    <div class="text-danger mb-2">{{ $errors->first() }}</div>
                @endif
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width: 100%">Login</button>
                </div>
            </form>

            <p>@lang('login.no_acc') <a href="/register">@lang('login.reghere')</a></p>
        </div>
    </div>
@endsection
