<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->callback_url = config('Consts.twitterinfo.callback_url');
  }

  /**
   *  ログイン
   *  @param  $request
   *  @return
   */
  public function login(Request $request)
  {
    // TwitterOAuthクラスをインスタンス化
    $conection = $this->authenticateAccount();
    
    // oauthリクエストトークンの取得
    $request_token = $conection->oauth('oauth/request_token', ['oauth_callback' => $this->callback_url]);
    
    // oauthリクエストトークンをセッションに格納
    $request->session()->put('twOauthToken', $request_token['oauth_token']);
    $request->session()->put('twOauthTokenSecret', $request_token['oauth_token_secret']);
    
    // twitter 認証へ
    // Twitter認証URLの作成
    $auth_url = $conection->url('oauth/authenticate', ['oauth_token' => $request_token['oauth_token']]);

    // Twitter認証画面へリダイレクト
    return redirect()->away($auth_url);
  }
  
  /**
   *  Twitterからのcallback
   *  @param  $request
   *  @return
   */
  public function callback(Request $request)
  {
    // session output
    $access_token = [
      'oauth_token'        => $request->session()->get('twOauthToken'),
      'oauth_token_secret' => $request->session()->get('twOauthTokenSecret')
    ];

    $conection = $this->authenticateAccount($access_token);

    $request->session()->put('twAccessToken',$conection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]));

    return redirect('showform');
  }
}
