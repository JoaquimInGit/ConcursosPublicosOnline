@component('mail::message')
# Introduction

The body of your message.

@component('mail::table')
| Numero do Anúncio        | Descrição           | Entidade       |   Link   |
| ------------------------ |:-------------------:|:--------------:|----------|
@foreach($contest as $c)
| {{$c->num_announcement}} | {{$c->description}} | {{$c->entity}} | <a href="{{route('contests.show', $c->id)}}" class="ml-2 button button-success">Ver</a> |
@endforeach
@endcomponent

@component('mail::button', ['url' => route('contests.show', $c->id)])
Ver Anúncios
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
