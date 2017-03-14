@component('layouts.default')
    @slot('title') 
        Reset Password
    @endslot
    <div class="row">
        <div class="col md-8 s12 l6 push-l3 pull-l3">
            <form class="form" role="form" method="POST" action="{{ route('password.email') }}">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title green-text centered">
                            <i class="fa fa-envelope"></i> Reset password
                        </span>
                        
                        <div class="container">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ csrf_field() }}
                            
                            <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-action centered">
                        <button type="submit" class="btn green waves-effect waves-light">
                            <i class="fa fa-send"></i> Send Password Reset Link
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
@endcomponent
