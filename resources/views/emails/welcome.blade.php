@component('mail::message')
# Welcome to Rebuy!

You recently register on Rebuy.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tincidunt commodo urna, ac fringilla tortor bibendum et. Pellentesque malesuada tellus in placerat ultricies.

@component('mail::button', ['url' => 'users/activation/'.$user->confirmation_code])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
