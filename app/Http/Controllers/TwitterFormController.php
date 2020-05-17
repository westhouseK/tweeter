<?php

namespace App\Http\Controllers;
require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Twitterapi;

class TwitterFormController extends Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->twitter = new Twitterapi;
  }
  // main display
  public function showForm(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');
    $conection = $this->authenticateAccount($access_token);
    $data = $this->twitter->getTwitterInfo($conection);

    return view('twitter_form', compact('data'));
  }

  // ajax
  public function postTweet(Request $request)
  {
    $tweet = $_POST['tweet'];
    $access_token = $request->session()->get('twAccessToken');
    $conection = $this->authenticateAccount($access_token);
    $result = $this->twitter->sendTweet($conection, $tweet);
    if (!empty($result->errors)) {
      $msg = $result->errors[0]->message;
    } else {
      $msg = 'OK';
    }
    return $msg;
  }
}
