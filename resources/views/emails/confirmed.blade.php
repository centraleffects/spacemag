@component('mail::message')
# {{__('emails.email_changed')}}

{{__('emails.email_change_successful', ['new_email' => $user->email])}}


{{__('emails.thanks')}},<br>
{{ config('app.name') }}
@endcomponent
