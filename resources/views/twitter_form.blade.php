@extends('common.layout')

@section('main-content')
  <form method="post">
    <div class="content-item mb-0"><textarea id="text_area" class="form-control" rows="8" cols="60" placeholder="いまどうしてる？"></textarea></div>
    <div class="text-right"><span id="length" class="h3">0</span> /140</div>
    <div class="content-item mt-0"><button id="tweet" type="button" class="btn btn-primary">ツイートする</button></div>
  </form>
  <table class="table table-hover">
  @foreach ($data['rank'] as $num => $rank)
    <tr>
      <td class="rank">{{ $num +1 }}位</td>
      <td><div id="hash" class="text-left rank">#{{ $rank }}</div><td>
      <td class="copy" style="vertical-align: middle;"><div id="{{ $num }}"><i class="fas fa-lg fa-clipboard"></i></div></td>
    </tr>
  @endforeach
  </table>
@endsection