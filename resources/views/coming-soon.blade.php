{{--
  Ten plik nie rozszerza @extends('layouts.app'),
  ponieważ chcemy mieć całkowicie czystą stronę bez nagłówka i stopki.
--}}
<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- wp_head() jest nadal potrzebne dla wtyczek i samego WP --}}
    @php(wp_head())
  </head>

  {{-- Dodajemy klasę 'coming-soon-page' do body dla łatwiejszego stylowania --}}
  <body @php(body_class('coming-soon-page'))>
    {{-- wp_footer() również jest ważne --}}
    @php(wp_footer())

    <div class="container">
      <h1>Wracamy wkrótce.</h1>
    </div>
  </body>
</html>