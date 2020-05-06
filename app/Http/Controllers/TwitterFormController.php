<?php

namespace App\Http\Controllers;
require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Twitterapi;
// View::makeができるようになる
// use Illuminate\Support\Facades\View;

class TwitterFormController extends Controller
{

  public function showForm()
  {
    $twitter = new Twitterapi;
    $data = $twitter->getTwitterInfo();

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
