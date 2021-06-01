@component('mail::message')
# Introduction

The body of your message.

@component('mail::table')
    | Numero do Anúncio       | Descrição         | Entidade  |
    | ------------- |:-------------:| --------:|
    @foreach($contest as $c)
    |  {{$c->num_announcement}}     |  {{$c->description}}     | {{$c->entity}}      |
    @endforeach
@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
