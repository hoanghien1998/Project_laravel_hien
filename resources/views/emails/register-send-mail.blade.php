@component('mail::message')
# New User: {{ $user->firstname }}

You create account successfully!!! Please login in page!!!

@component('mail::button', ['url' => 'http://hien-web.service.docker/'])
Button view your profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
