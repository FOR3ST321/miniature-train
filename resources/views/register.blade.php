@extends('header_footer')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="margin-top:50px;margin-bottom:50px">
        <div class="container" style="width:500px;background-color:white;padding:20px">
            <h3 class="text-center">REGISTER</h3>
            <p class="text-center">Register to BeeVerse!</p>
            <p>Already have account? <a href="/login">Login Here</a></p>
            <form action="/register" method="post" style="margin-top: 20px" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="font-weight-bold">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" placeholder="Enter your name here..." value="{{ @old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Gender</label>
                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="" selected disabled>Select Gender...</option>
                        <option value="Male" {{ @old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female"{{ @old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Age</label>
                    <input placeholder="Input your Age" type="number" value="{{ @old('age') }}"
                        class="form-control @error('instagram_link') is-invalid @enderror" name="age">
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Phone Number</label>
                    <input placeholder="Insert Phone Number" type="text" value="{{ @old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror" name="phone">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Address</label>
                    <textarea placeholder="Insert Your Address" name="address" id="" cols="30" rows="5"
                        class="form-control @error('address') is-invalid @enderror">{{ @old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold" style="margin-bottom:5px">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" placeholder="Enter email"value="{{ @old('email') }}">
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
                        placeholder="Enter Password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold" style="margin-bottom:5px">Confirm Password</label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" placeholder="Enter Password Confirmation">
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h5 style="margin-top:40px">Hobby List</h5>
                <hr>
                <p>Please Insert min 3 Hobby</p>
                <div class="d-flex flex-column">
                    <div class="card" style="width: 100%;margin-bottom:30px">
                        <div class="card-body">
                            <h6 class="card-title">Hobby 1</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Name</label>
                                <input type="text" class="form-control @error('hobby_name.0') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="Enter your hobby here..."
                                    value="{{ @old('hobby_name.0') }}">
                                @error('hobby_name.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Description</label>
                                <textarea placeholder="Tell us about your hobby" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.0') is-invalid @enderror">{{ @old('hobby_description.0') }}</textarea>
                                @error('hobby_description.0')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Your Hobby Photo</label>
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
                            <h6 class="card-title">Hobby 2</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Name</label>
                                <input type="text" class="form-control @error('hobby_name.1') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="Enter your hobby here..."
                                    value="{{ @old('hobby_name.1') }}">
                                @error('hobby_name.1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Description</label>
                                <textarea placeholder="Tell us about your hobby" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.1') is-invalid @enderror">{{ @old('hobby_description.1') }}</textarea>
                                @error('hobby_description.1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Your Hobby Photo</label>
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
                            <h6 class="card-title">Hobby 3</h6>
                            <hr>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Name</label>
                                <input type="text" class="form-control @error('hobby_name.2') is-invalid @enderror"
                                    id="name" name="hobby_name[]" placeholder="Enter your hobby here..."
                                    value="{{ @old('hobby_name.2') }}">
                                @error('hobby_name.2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Hobby Description</label>
                                <textarea placeholder="Tell us about your hobby" name="hobby_description[]" id="" cols="30"
                                    rows="5" class="form-control @error('hobby_description.2') is-invalid @enderror">{{ @old('hobby_description.2') }}</textarea>
                                @error('hobby_description.2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Your Hobby Photo</label>
                                <input type="file" name='photo[]'
                                    class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @dump($errors)
                @if ($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" style="width: 100%;margin-top:10px">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
