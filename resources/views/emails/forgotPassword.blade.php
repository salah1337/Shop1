@component('mail::message')
# Password Reset
Hi,
Click the button below to change your password.

<div>
    @component('mail::button', ['url' => 'http://localhost:3000/reset/{{$token}}'])
        Reset Password
    @endcomponent
</div>

<br>
or click this 
<a href='http://localhost:3000/reset/{{$token}}'>
    link
</a>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
