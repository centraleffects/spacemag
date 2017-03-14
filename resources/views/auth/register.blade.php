@component('layouts.default')
    @slot('title')
        Register
    @endslot
    <div class="row">
        <div class="col md-8 s12 l6 push-l3 pull-l3">
            <form class="form" role="form" method="POST" action="{{ route('register') }}">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title green-text centered">
                            <i class="fa fa-user-plus"></i> Register
                        </span>
                        
                        <div class="container">
                            <div class="input-field centered">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <a href="{{ url('login/fb') }}" class="btn blue lighten-2 waves-effect waves-light">
                                    <i class="fa fa-facebook-official"></i> Sign Up with Facebook
                                </a>
                            </div>
                            <div class="div-seperator">or</div>
                            
                            {{ csrf_field() }}

                            <div class="input-field{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First Name</label>

                                <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>

                                <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>

                                <input id="email" type="email" name="email" value="{{ old('email') }}" required />

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>

                                <input id="password" type="password" name="password" autocomplete="off" required />

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" name="password_confirmation" autocomplete="off" required />
                            </div>
                        </div>
                    </div>
                    <div class="card-action centered">
                        <button type="submit" class="btn green waves-effect waves-light">
                            <i class="fa fa-check"></i> Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endcomponent
