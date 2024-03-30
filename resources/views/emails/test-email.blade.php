@component('mail::message')
# Hello {{$name}},

Thank you for choosing our service!

@component('mail::button', ['url' => $link])
Visit Our Website
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
