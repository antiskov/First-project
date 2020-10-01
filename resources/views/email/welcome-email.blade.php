@component('mail::message')
# Introduction

Дякую за реєстрацію.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
