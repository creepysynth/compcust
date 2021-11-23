<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Register</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>


<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ route('homepage') }}"><b>{{ config('app.name') }}</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{ route('user.register') }}" method="post">
        @csrf

        <div class="input-group">
          <input type="text" class="form-control" name="name"  placeholder="Full name" value="{{ old('name', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('name'))
          @foreach ($errors->get('name') as $error)
            <div class="text-sm" style="color:red;">{{ $error }}</div>
          @endforeach
        @endif

        <div class="input-group mt-3">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('email'))
          @foreach ($errors->get('email') as $error)
            <div class="text-sm" style="color:red;">{{ $error }}</div>
          @endforeach
        @endif

        <div class="input-group mt-3">
          <input type="password" class="form-control" name="password" placeholder="Password" value="{{ old('password', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('password'))
          @foreach ($errors->get('password') as $error)
            <div class="text-sm" style="color:red;">{{ $error }}</div>
          @endforeach
        @endif
        <div class="input-group mt-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password" value="{{ old('password_confirmation', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row mb-2 mt-3">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Register</button>
          </div>
        </div>
      </form>
      <a href="{{ route('user.login.form') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div>
</div>
<!-- /.login-box -->

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
