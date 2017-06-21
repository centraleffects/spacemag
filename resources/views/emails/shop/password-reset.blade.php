@component('mail::message')
# {{ __("emails.password_changed") }}

{{__("emails.hi")}} {{ ucfirst($user->first_name) }},

{{ __("emails.password_change_body_message") }}
- {{ $password }}

@component('mail::button', ['url' => url('/login'), 'color' => 'green'])
{{ __('emails.click_login') }}
@endcomponent

{{ __('messages.thanks') }},<br>
{{ config('app.name') }}
@endcomponent
