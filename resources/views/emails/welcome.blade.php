@component('mail::message')
# Welcome to Rebuy!

You recently register on Rebuy.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tincidunt commodo urna, ac fringilla tortor bibendum et. Pellentesque malesuada tellus in placerat ultricies.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
