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
    <p class='text-left'>{{ $num +1 }}位　#{{ $rank }}<i class="fas fa-clipboard"></i></p>
  @endforeach
@endsection