@extends('common.layout')

@section('main-content')
  <div>
    <h3>このアプリについて</h3>
    <div  class="mb-2">使用技術</div>
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
    <div class="mt-2">作成者</div>
    <p>うえすと(<a href="https://twitter.com/westhouse_k">@westhouse_k<a>)</p>
  </div>
@endsection