<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | Log in</title>

  <!-- Google Font: Source Sans Pro -->
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
    <div class="card-body login-card-body">
      @if(session()->has('message-success'))
        <p class="login-box-msg" style="color: green">{{ session()->get('message-success') }}</p>
      @else
        <p class="login-box-msg">Sign in to start your session</p>
      @endif

      <form action="{{ route('user.login') }}" method="post">
        @csrf

        <div class="input-group">
          <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ old('email', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('email'))
          @foreach ($errors->get('email') as $error)
            <div class="text-sm mb-2" style="color:red;">{{ $error }}</div>
          @endforeach
        @endif

        <div class="input-group mt-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password', '') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @if ($errors->has('password'))
          @foreach ($errors->get('password') as $error)
            <div class="text-sm mb-2" style="color:red;">{{ $error }}</div>
          @endforeach
        @endif

        <div class="row mb-3 mt-3">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mb-0">
        <a href="{{ route('user.register.form') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
