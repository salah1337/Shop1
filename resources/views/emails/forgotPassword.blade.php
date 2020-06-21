@component('mail::message')
# Introduction

Click the button below to change your password.
{{$token}}

<a href='http://localhost:6969/reset/{{$token}}'>
    @component('mail::button', ['url' => ''])
        Reset Password
    @endcomponent
</a>
or click this link
<a href='http://localhost:6969/reset/{{$token}}'>
    http://localhost:6969/reset/{{$token}}
</a>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
