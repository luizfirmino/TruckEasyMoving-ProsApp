@extends('layouts.auth')

@section('content')

       
        <form method="POST" action="{{route('login')}}">
            @csrf

                
                <div class="form-group-material">
                    <input id="email" type="email" class="input-material" name="email" value="{{ old('email') }}" required autocomplete="email">

                    <label for="login-username" class="label-material">{{ __('E-Mail Address') }}</label>
                    
                    @error('email')
                       
                            <strong>{{ $message }}</strong>
                       
                    @enderror
                </div>

                <div class="form-group-material">
                    <input id="password" type="password" class="input-material" name="password" required autocomplete="current-password">
                    <label for="password" class="label-material">{{ __('Password') }}</label>

                    @error('password')
                        
                            <strong>{{ $message }}</strong>
                        
                    @enderror
                </div>

                <div class="form-group-material">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button><br/>

                    @if (Route::has('password.request'))
                        <a class="forgot-pass" href="password/reset">
                            {{ __('Forgot Your Password?') }}
                        </a><br/>
                    @endif
            
                <small>Do not have an account? </small><a href="{{route('register')}}" class="signup">Signup</a>
            
        </form>
      
@endsection
