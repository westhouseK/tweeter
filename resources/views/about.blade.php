@extends('common.layout')

@section('main-content')
  <div class="mb-5">
    <h3 class="about-title mb-3">このアプリについて</h3>
    <u class="about-sub h5 mb-2">使用技術</u>
    <div class="m-2">
      <table>
        <tr>
          <td class="about-item text-right">サーバーサイド：</td>
          <td class="about-item text-left">PHP(Laravel)</td>
        </tr>
        <tr>
          <td class="about-item text-right">フロントエンド：</td>
          <td class="about-item text-left">JavaScript(jQuery) CSS(Bootstrap)</td>
        </tr>
        <tr>
          <td class="about-item text-right">インフラ：</td>
          <td class="about-item text-left">Docker AWS</td>
        </tr>
        <tr>
          <td class="about-item text-right">バージョン管理：</td>
          <td class="about-item text-left">GitHub</td>
        </tr>
      </table>
    </div>
    <u class="about-sub h5 mt-2">作成者</u>
    <p class="about-name">うえすと(<a href="https://twitter.com/westhouse_k">@westhouse_k<a>)</p>
  </div>
@endsection