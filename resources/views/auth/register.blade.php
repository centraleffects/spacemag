@component('layouts.default')
    @slot('title')
        Sign Up
    @endslot
    <div class="card bordered z-depth-2"  style="margin:0% auto;">
        <div class="card-content centered">
            <div class="m-b-30">
                <div class="card-title strong">
                    <h2 class="green-text"><i class="glyphicon glyphicon-email"></i> Sign Up</h2>
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

                <button class="btn btn-info">
            		Sign Up with Facebook
            	</button>

            	<div class="div-seperator">or</div>
            	<div class="row">
            		<div class="col-md-12">
            			<form class="form-floating" role="form" method="POST" action="{{ route('register') }}">
		                    {{ csrf_field() }}

		                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
		                        <label for="first_name" class="control-label">First Name</label>

		                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

		                            @if ($errors->has('first_name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('first_name') }}</strong>
		                                </span>
		                            @endif
		                    </div>

		                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
		                        <label for="last_name" class="control-label">Last Name</label>

		                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

		                            @if ($errors->has('last_name'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('last_name') }}</strong>
		                                </span>
		                            @endif
		                    </div>


		                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		                        <label for="email" class="control-label">E-Mail Address</label>

		                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

		                            @if ($errors->has('email'))
		                                <span class="help-block">
		                                    <strong>{{ $errors->first('email') }}</strong>
		                                </span>
		                            @endif
		                    </div>

		                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		                        <label for="password" class="control-label">Password</label>

	                            <input id="password" type="password" class="form-control" name="password" required>

	                            @if ($errors->has('password'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('password') }}</strong>
	                                </span>
	                            @endif
		                    </div>

		                    <div class="form-group">
		                        <label for="password-confirm" class="control-label">Confirm Password</label>
		                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
		                    </div>

		                    <div class="form-group">
		                        <button type="submit" class="btn btn-primary pull-right">
		                            Register
		                        </button>
		                    </div>
		                </form>
            		</div>
            	</div>
            </div>
        </div>
    </div>
@endcomponent
