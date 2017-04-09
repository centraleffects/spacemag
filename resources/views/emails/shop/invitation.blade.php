@component('mail::message')
# {{ isset($subject) ? $subject : "Start shopping now before it's too late." }}

Hi {{ ucfirst($user->first_name) }},

Be the first to know about discounts and offers at {{ $shop->name }}!

@if( isset($user->plain_password) )
You may login using these credentials:
- {{ $user->email }}
- {{ $user->plain_password }}

You can change your password later.
@endif

@component('mail::button', ['url' => url('/shops/'.$shop->id.'/subscribe'), 'color' => 'green'])
Click here to subscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
