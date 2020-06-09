<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function __construct()
  {
    $this->api_key           = config('Consts.twitterauth.api_key');
    $this->api_secret_key    = config('Consts.twitterauth.api_secret_key');
  }

  /**
   *  画面に表示するデータを取得
   *  @param  array $access_token
   *  @return object
   */
  protected function authenticateAccount($access_token = [])
  {
    if (!empty($access_token['screen_name'])) Log::info($access_token['screen_name']);

    if (!empty($access_token)) {
      $conection = new TwitterOAuth($this->api_key, $this->api_secret_key, $access_token['oauth_token'], $access_token['oauth_token_secret']);
    } else {
      $conection = new TwitterOAuth($this->api_key, $this->api_secret_key);
    }
    return $conection;
  }
}
