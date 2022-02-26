@component('mail::message')
    # Reporte de usuarios por país

@component('mail::table')
| Código    | Usuarios  |
|:------:   |:--------: |
@foreach($reporte as $pais)
    | {{$pais->pais}}     |        {{$pais->usuarios}} |
@endforeach
@endcomponent
    Gracias,<br>
    {{ config('app.name') }}
@endcomponent
