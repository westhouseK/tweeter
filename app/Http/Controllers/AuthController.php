<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;


class AuthController extends Controller
{
  public function __construct()
  {
    $this->api_key        = config('Consts.twitterauth.api_key');
    $this->api_secret_key = config('Consts.twitterauth.api_secret_key');
    $this->callback_url   = config('Consts.twitterinfo.callback_url');
  }
  public function login(Request $request)
  {
    // TwitterOAuthクラスをインスタンス化
    $conection = new TwitterOAuth($this->api_key, $this->api_secret_key);
    
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
  
  public function callback(Request $request)
  {
    $conection = new TwitterOAuth($this->api_key, 
                                  $this->api_secret_key, 
                                  $request->session()->get('twOauthToken'), 
                                  $request->session()->get('twOauthTokenSecret'));

    $request->session()->put('twAccessToken',$conection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]));

    return redirect('showform');
  }
}
