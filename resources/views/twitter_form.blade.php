@extends('common.layout')

@section('child')
  <p>{{ $data['name'] }}さん</p>
  <textarea class="form-control" rows="5"></textarea>
  <br>
  <button type="button" class="btn btn-primary tweet">ツイート</button>
  <br>
  <br>
  @foreach ($data['rank'] as $num => $rank)
    <p class='text-left'>{{ $num +1 }}位　#{{ $rank }}</p>
  @endforeach
@endsection