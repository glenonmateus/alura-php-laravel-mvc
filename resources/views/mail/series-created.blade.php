@component("mail::message")
A série {{ $seriesName }} com {{ $seasons }} temporadas e {{ $episodes }} episódios por temporada foi criada com sucesso.

Acesse aqui:

@component('mail::button', ['url' => route('seasons.index', $idSeries)])
Ver série
@endcomponent

@endcomponent
