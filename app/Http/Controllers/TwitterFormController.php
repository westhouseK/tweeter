<?php

namespace App\Http\Controllers;
require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Twitterapi;

// View::makeができるようになる
// use Illuminate\Support\Facades\View;

class TwitterFormController extends Controller
{
  // main display
  public function showForm(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');
    $conection = $this->authenticateAccount($access_token);

    $twitter = new Twitterapi;
    $data = $twitter->getTwitterInfo($conection);

    return view('twitter_form', compact('data'));
  }

  // ajax
  public function postTweet(Request $request)
  {
    $tweet = $_POST['tweet'];
    $access_token = $request->session()->get('twAccessToken');
    $conection = $this->authenticateAccount($access_token);

    $twitter = new Twitterapi;
    $result = $twitter->sendTweet($conection, $tweet);
    if (!empty($result->errors)) {
      $msg = $result->errors[0]->message;
    } else {
      $msg = 'OK';
    }
    return $msg;
  }
}
