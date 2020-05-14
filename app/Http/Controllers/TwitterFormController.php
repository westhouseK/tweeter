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
  public function callback(Request $request)
  {
    $objTwitterConection = new TwitterOAuth(config('Consts.twitterauth.api_key'), config('Consts.twitterauth.api_secret_key'), $request->session()->get('twOauthToken'), $request->session()->get('twOauthTokenSecret'));

    $request->session()->put('twAccessToken',$objTwitterConection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier'])));

    return redirect('showform');

  }
  public function showForm(Request $request)
  {
    var_dump($request->session()->get('twAccessToken'));
    var_export($request->session()->all());

    $twitter = new Twitterapi;
    $data = $twitter->getTwitterInfo($request);

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
}
