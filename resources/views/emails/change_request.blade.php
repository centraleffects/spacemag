@component('mail::message')
# {{__('emails.email_request')}}

{{__('emails.email_change_request', ['old_email' => $user->email, 'new_email' => $new_email])}}

@component('mail::button', ['url' => url('profile/confirm/email/'.$token)])
{{__('emails.confirm')}}
@endcomponent

{{__('emails.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
