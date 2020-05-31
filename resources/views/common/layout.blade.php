<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    @include('parts.head')
    @include('parts.modal')
    </head>
    <body>
      @include('parts.loading')
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
