<?php

namespace App\Http\Controllers;
require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Twitterapi;
use Abraham\TwitterOAuth\TwitterOAuth;

// View::makeができるようになる
// use Illuminate\Support\Facades\View;

class TwitterFormController extends Controller
{
  public function __construct()
  {
    $this->api_key         = config('Consts.twitterauth.api_key');
    $this->api_secret_key  = config('Consts.twitterauth.api_secret_key');
  }

  public function showForm(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');
    $conection = $this->authenticateAccount($access_token);

    $twitter = new Twitterapi;
    $data = $twitter->getTwitterInfo($conection);

    return view('twitter_form', compact('data'));
  }

  // ajax
  public function postTweet()
  {
    $tweet = $_POST['tweet'];
    $twitter = new Twitterapi;
    $result = $twitter->sendTweet($tweet);
    if (!empty($result->errors)) {
      $msg = $result->errors[0]->message;
    } else {
      $msg = 'OK';
    }
    return $msg;
  }

  private function authenticateAccount($access_token)
  {
    $conection = new TwitterOAuth($this->api_key, 
                                  $this->api_secret_key, 
                                  $access_token['oauth_token'], 
                                  $access_token['oauth_token_secret']);
    return $conection;
  }
}
