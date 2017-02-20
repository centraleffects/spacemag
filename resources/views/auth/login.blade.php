@extends('layouts.default')

@section('content')
<div class="card-content">
    <form class="form-floating" role="form" method="POST" action="{{ route('login') }}">
        <div class="m-b-30">
            <div class="card-title strong">
                <h2 class="green-text"><i class="md md-lock-open"></i> Login</h2>
            </div>
            <p class="card-title-desc">
                Welcome to Rebuy.se! The admin template for material design lovers.
            </p>
        </div>
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="inputPassword" class="control-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
        </div>
        
    </div>
    <div class="card-action clearfix">
        <div class="pull-right">
            <a href="{{ route('password.request') }}" class="btn">Forgot password</a>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </div>
</form>
@stop
