@component('mail::message')
# Your password has been changed.

Hi {{ ucfirst($user->first_name) }},

This is just to inform you that your password has been changed recently.
You can login now using this password:
- {{ $password }}

@component('mail::button', ['url' => url('/login'), 'color' => 'green'])
Click here to login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
