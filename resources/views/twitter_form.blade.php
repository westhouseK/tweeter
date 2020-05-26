@extends('common.layout')

@section('main-content')
  <form method="post">
    <!-- @csrf -->
    <div class="item mb-0"><textarea id="text_area" class="form-control" rows="10" cols="70" placeholder="いまどうしてる？"></textarea></div>
    <div class="text-right"><span id="length" class="h3">0</span> /140</div>
    <div class="item"><button id="tweet" type="button" class="btn btn-primary">ツイートする</button></div>
  </form>
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