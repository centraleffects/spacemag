@extends('layouts.default')

@section('content')
<div class="card-content">
    <div class="m-b-30">
        <div class="card-title strong">
            <h2 class="green-text"><i class="md md-email"></i> Reset password</h2>
        </div>
        <p class="card-title-desc">
            Welcome to Rebuy.se! The admin template for material design lovers.
        </p>
    </div>
    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-floating" role="form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
