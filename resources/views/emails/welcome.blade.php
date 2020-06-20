@component('mail::message')
# Welcome to chopSHOP

We're very happy that you joined us, we hope you have the best experience in our platform.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
