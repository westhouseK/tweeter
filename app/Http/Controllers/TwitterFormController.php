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
    $data = ['response' => 'ツイートに成功しました！'];
    return json_encode($data);
  }
}
