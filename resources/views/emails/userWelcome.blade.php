@component('mail::message')
    # Hola, {{$user->nombres}},

@component('mail::panel')
    Tu cuenta ha sido creada exitosamente.
@endcomponent
    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
