@component('mail::message')
# {{ isset($subject) ? $subject : "Start shopping now before it's too late." }}

Hi {{ $user->first_name }},

Be the first to know about discounts and offers at {{ $shop->name }}!

@if( isset($user->plain_password) )
Pleas login using these credentials:
- {{ $user->email }}
- {{ $user->plain_password }}
@endif

@component('mail::button', ['url' => url('/shops/'.$shop->id.'/subscribe')])
Click here to subscribe
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
