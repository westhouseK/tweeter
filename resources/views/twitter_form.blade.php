@extends('common.layout')

@section('child')
  <p>
    <span class="h4">{{ $data['name'] }}</span>さん  
    <span><img class="rounded-circle" src="{{ $data['profile'] }}" /></span>
  </p>
    <form method="post">
    <!-- @csrf -->
    <textarea id="text_area" class="form-control" rows="10" cols="60" placeholder="いまどうしてる？"></textarea>
    <div class="text-right"><span id="length" class="h3">0</span> /140</div>
    <br>
    <button id="tweet" type="button" class="btn btn-primary">ツイートする</button>
  </form>
  <br>
  <br>
  <table class="table table-hover">
  @foreach ($data['rank'] as $num => $rank)
    <tr>
      <td>{{ $num +1 }}位</td>
      <td><div id="hash" class="text-left">#{{ $rank }}</div><td>
      <td class="copy" style="vertical-align: middle;"><div id="{{ $num }}"><i class="fas fa-lg fa-clipboard"></i></div></td>
    </tr>
  @endforeach
  </table>
@endsection