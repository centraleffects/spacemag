@component('layouts.default')
    @slot('title') 
        Reset Password
    @endslot
    <div class="row">
        <div class="col md-8 s12 l6 push-l3 pull-l3">
            <form class="form" role="form" method="POST" action="{{ route('password.request') }}">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title green-text centered">
                            <i class="material-icons">email</i>Reset password
                        </span>
                        
                        <div class="container">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ csrf_field() }}
                            
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>

                                <input id="email" class="validate" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>

                                <input id="password" type="password" name="password" required>
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                            <div class="input-field{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm">Confirm Password</label>
                                
                                <input id="password-confirm" type="password" name="password_confirmation" required>
                            </div>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-action centered">
                        <button type="submit" class="btn blue lighten-2 waves-effect waves-light">Send Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endcomponent
