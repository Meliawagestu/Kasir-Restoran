@extends('auth.main')
@section('title','Login')
@section('content')
  <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header" style="text-align: center;"><h5>Login</h5></div>
        <div class="card-body">
          <form method="POST" action="{{route('login')}}">
            {{csrf_field()}}
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" id="inputUsername" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                name="username" value="{{ old('username') }}"  
                 placeholder="Masukan Username" required autofocus>
                <label for="inputUsername">Username</label>
                @if($errors->has('username'))
                <div class="invalid-feedback">{{$errors->first('username')}}</div>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                name="password" 
                 placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
                @if($errors->has('password'))
                <div class="invalid-feedback">{{$errors->first('password')}}</div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="remember" {{ old('remember') ? 'checked':''}}>
                  Remember Password
                </label>
              </div>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button><br>
          </form>
          <div class="text-center">
            <a class="d-block small" href="{{route('register')}}">Belum Punya Akun?</a>
          </div>
        </div>
      </div>
    </div>
@endsection

