@component('mail::message')

Final step...
 
Confirm your email address to complete your {{ ucwords(config('app.name')) }} account.
It's easy — just click the button below.

@component('mail::button', ['url' => url('').'/admin/verification/'.$admin->token.''])
Confirm now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
