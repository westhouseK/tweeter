<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('parts.head')
    </head>
    <body>
      <!-- Todo: パーツ化 -->
      <div id="overlay">
        <div class="cv-copy">
          <h2>Now Tweet...</h2>
        </div>
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
      </div>
      <div class="wrapper">
        <div class="card">
        @include('parts.header')
          <div class="main">
              <div class="content">
              @yield('main-content')
              </div>
          </div>
        @include('parts.footer')
        </div>
      </div>
    </body>
</html>
