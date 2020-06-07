@extends('common.layout')

@section('main-content')
  <div class="mb-5">
    <h3 class="mb-3">このアプリについて</h3>
    <u class="h5 mb-2">使用技術</u>
    <div class="m-2">
      <table>
        <tr>
          <td class="text-right">サーバーサイド：</td>
          <td class="text-left">PHP(Laravel)</td>
        </tr>
        <tr>
          <td class="text-right">フロントエンド：</td>
          <td class="text-left">JavaScript(jQuery) CSS(Bootstrap)</td>
        </tr>
        <tr>
          <td class="text-right">インフラ：</td>
          <td class="text-left">Docker AWS</td>
        </tr>
        <tr>
          <td class="text-right">バージョン管理：</td>
          <td class="text-left">GitHub</td>
        </tr>
      </table>
    </div>
    <u class="h5 mt-2">作成者</u>
    <p>うえすと(<a href="https://twitter.com/westhouse_k">@westhouse_k<a>)</p>
  </div>
@endsection