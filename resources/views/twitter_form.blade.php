@extends('common.layout')

@section('child')
  <p>{{ $data['name'] }}さん</p>
  <form method="post">
    <!-- @csrf -->
    <textarea id="text_area" class="form-control" rows="10" cols="60" placeholder="いまどうしてる？"></textarea>
    <div class="text-right"><span id="length" class="h3">0</span> /140</div>
    <br>
    <button id="tweet" type="button" class="btn btn-primary">ツイート</button>
  </form>
  <br>
  <br>
  @foreach ($data['rank'] as $num => $rank)
  <div class="container-fluid">
    <div class="row">
      <span class="text col-3 text-left">
        <span>{{ $num +1 }}位 </span>
        <span id="hash">#{{ $rank }}</span>
      </span>
      <span id="{{ $num }}" class="copy col-3"><i class="fas fa-lg fa-clipboard"></i></span>
      <br>
    </div>
  </div>
  @endforeach
@endsection