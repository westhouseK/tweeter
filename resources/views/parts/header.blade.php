<header>
  <h2 class="logo nav-item">Tweeter.</h2>
  <nav>
    <div class="nav-item">{{ $data['name'] ?? '' }}</div>
    @if (!empty($data['profile']))
      <img class="rounded-circle nav-item" src="{{ $data['profile'] }}" />
    @endif
  </nav>
</header>
