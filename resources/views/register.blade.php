@extends('header_footer')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="margin-top:50px;margin-bottom:50px">
        <div class="container" style="width:500px;background-color:white;padding:20px">
            <h3 class="text-center">REGISTER</h3>
            <p>@lang('register.hasacc') <a href="/login">@lang('register.login')</a></p>
            <form action="/register" method="post" style="margin-top: 20px" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">@lang('profile.name')</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="@lang('register.placename')" value="{{ @old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Gender</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="" selected disabled>@lang('register.select') Gender...</option>
                        <option value="Male" {{ @old('gender') == 'Male' ? 'selected' : '' }}>@lang('home.male')</option>
                        <option value="Female"{{ @old('gender') == 'Female' ? 'selected' : '' }}>@lang('home.female')</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">@lang('profile.age')</label>
                    <input placeholder="@lang('register.placeage')" type="number" value="{{ @old('age') }}"
                        class="form-control @error('instagram_link') is-invalid @enderror" name="age">
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">@lang('profile.phone')</label>
                    <input placeholder="@lang('register.placephone')" type="text" value="{{ @old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror" name="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">@lang('profile.address')</label>
                    <textarea placeholder="@lang('register.placeaddress')" name="address" id="" cols="30" rows="5"
                        class="form-control @error('address') is-invalid @enderror">{{ @old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold" style="margin-bottom:5px">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="@lang('register.placeemail')" value="{{ @old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Instagram Link</label>
                    <input placeholder="https://www.instagram.com/(username)" type="text"
                        value="{{ @old('instagram_link') }}"
                        class="form-control @error('instagram_link') is-invalid @enderror" name="instagram_link">
                    @error('instagram_link')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold" style="margin-bottom:5px">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="@lang('register.placepass')">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold" style="margin-bottom:5px">@lang('register.confirm')</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" placeholder="@lang('register.placeconfirm')">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">@lang('register.hobbylist')</h5>
                <hr>
                <p>@lang('register.pleasehobby')</p>
                <div class="d-flex flex-column">
                    <div class="card" style="width: 100%;margin-bottom:30px">
                        <div class="card-body">
                            <h6 class="card-title">@lang('register.hobby') 1</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyname')</label>
                                <input type="text" class="form-control @error('hobby_name.0') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="@lang('register.placehobby')"
                                    value="{{ @old('hobby_name.0') }}">
                                @error('hobby_name.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbydesc')</label>
                                <textarea placeholder="@lang('register.placedesc')" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.0') is-invalid @enderror">{{ @old('hobby_description.0') }}</textarea>
                                @error('hobby_description.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyphoto')</label>
                                <input type="file" name='photo[]'
                                    class="form-control @error('photo') is-invalid @enderror" accept="image/*" />
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 100%;margin-bottom:30px">
                        <div class="card-body">
                            <h6 class="card-title">@lang('register.hobby') 2</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyname')</label>
                                <input type="text" class="form-control @error('hobby_name.1') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="@lang('register.placehobby')"
                                    value="{{ @old('hobby_name.1') }}">
                                @error('hobby_name.1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbydesc')</label>
                                <textarea placeholder="@lang('register.placedesc')" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.1') is-invalid @enderror">{{ @old('hobby_description.1') }}</textarea>
                                @error('hobby_description.1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyphoto')</label>
                                <input type="file" name='photo[]'
                                    class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card" style="width: 100%;margin-bottom:30px">
                        <div class="card-body">
                            <h6 class="card-title">@lang('register.hobby') 3</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyname')</label>
                                <input type="text" class="form-control @error('hobby_name.2') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="@lang('register.placehobby')"
                                    value="{{ @old('hobby_name.2') }}">
                                @error('hobby_name.2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbydesc')</label>
                                <textarea placeholder="@lang('register.placedesc')" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.2') is-invalid @enderror">{{ @old('hobby_description.2') }}</textarea>
                                @error('hobby_description.2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">@lang('register.hobbyphoto')</label>
                                <input type="file" name='photo[]'
                                    class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width: 100%;margin-top:10px">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
