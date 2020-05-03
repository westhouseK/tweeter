@extends('common.layout')

@section('child')
  <p>{{ $data['name'] }}さん</p>
  <form method="post">
    <!-- @csrf -->
    <textarea id="text_area" class="form-control" rows="5" placeholder="いまどうしてる？"></textarea>
    <br>
    <button type="button" class="btn btn-primary tweet">ツイート</button>
  </form>
  <br>
  <br>
  @foreach ($data['rank'] as $num => $rank)
    <p class='text-left'>{{ $num +1 }}位　#{{ $rank }}</p>
  @endforeach
@endsection