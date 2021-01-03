@extends('layouts.auth')

@section('content')
        
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="text-left form-validate" enctype="multipart/form-data">
            @csrf

                
                    <div class="form-group-material">
                        <input id="firstName" type="text" class="input-material" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
                        <label for="firstName" class="label-material">{{ __('First name') }}</label>
                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-material">
                        <input id="lastName" type="text" class="input-material" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
                        <label for="lastName" class="label-material">{{ __('Last name') }}</label>
                        @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>    
                

               <div class="form-group-material">
                    <input id="email" type="email" class="input-material" name="email" value="{{ old('email') }}" required autocomplete="email">
                    <label for="email" class="label-material">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="form-group-material">
                    <input id="phoneNumber" type="text" class="input-material" name="phoneNumber" value="{{ old('phoneNumber') }}" required autocomplete="phoneNumber">
                    <label for="phoneNumber" class="label-material">{{ __('Phone Number') }}</label>
                    @error('phoneNumber')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            
                <div class="form-group-material">
                    <label for="profilePicture" class="label-material">{{ __('Profile picture') }}</label>
                    <input id="profilePicture" type="file" class="input-material" name="profilePicture" required>
                    @error('profilePicture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group-material">
                    <input id="password" type="password" class="input-material" name="password" required autocomplete="new-password">
                    <label for="password" class="label-material">{{ __('Password') }}</label>
                    @error('password')
                        <span class="label-material" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group-material">
                    <input id="password-confirm" type="password" class="input-material" name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirm" class="label-material">{{ __('Confirm Password') }}</label>
                </div>

                
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
        </form>


        <small>Already have an account? </small><a href="{{ route('login') }}" class="signup">Login</a>
                           
                        
                
@endsection
