@component('mail::message')
# {{ isset($subject) ? $subject : "Start shopping now before it's too late." }}

Hi {{ ucfirst($user->first_name) }},

{{ ucfirst($current_user->first_name).' '.ucfirst($current_user->last_name) }} created an account for you at {{ $shop->name }}!

@if( isset($user->plain_password) )
You may login using these credentials:
- {{ $user->email }}
- {{ $user->plain_password }}

You can change your password later.
@endif

@component('mail::button', ['url' => url('/shops/'.$shop->id.'/subscribe'), 'color' => 'green'])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
