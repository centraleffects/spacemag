@component('layouts.default')
    @slot('title') 
        Login
    @endslot
    <div class="row">
        <div class="col md-8 s12 l6 push-l3 pull-l3">
            <form class="form" role="form" method="POST" action="{{ route('login') }}">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title green-text centered">
                            <i class="material-icons">lock_outline</i>Login
                        </span>
                        
                        <div class="container">
                            <div class="input-field centered">
                                <a href="{{ url('login/fb') }}" class="waves-effect waves-light btn blue lighten-2">Login with Facebook</a>
                            </div>
                            <div class="div-seperator">or</div>
                            {{ csrf_field() }}
                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input type="password" id="password" name="password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field">
                                @if ($errors->has('email'))
                                    <span class="help-block red-text lighten-1">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-field">
                                <p>
                                    <input type="checkbox" id="remember" name="remember" value="true" />
                                    <label for="remember">Remember Me</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action centered">
                        <a href="{{ route('password.request') }}">Forgot password</a>
                        <button type="submit" class="btn blue lighten-2 waves-effect waves-light">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endcomponent
