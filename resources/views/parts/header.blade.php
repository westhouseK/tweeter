<header>
  <a style="text-decoration: none;" href="/showform"><h2 class="logo nav-item">Tweeter.</h2></a>
  <nav>
    <div class="nav-item">{{ $data['name'] ?? '' }}</div>
    @if (!empty($data['profile']))
      <img class="rounded-circle nav-item" src="{{ $data['profile'] }}" />
    @endif
  </nav>
</header>
