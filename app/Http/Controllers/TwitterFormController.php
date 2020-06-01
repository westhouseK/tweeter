<?php

namespace App\Http\Controllers;
require base_path('vendor/autoload.php');

use Illuminate\Http\Request;
use App\Twitterapi;
use Illuminate\Support\Facades\Log;


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
    Log::debug($access_token);

    // セッション切れ
    if(empty($access_token)) return redirect('timeout');

    $conection = $this->authenticateAccount($access_token);
    $data = $this->twitter->getTwitterInfo($conection);

    return view('twitter_form', compact('data'));
  }

  public function showTimeout()
  {
    return view('timeout');
  }

  public function showAbout()
  {
    return view('about');
  }

  // ajax
  public function postTweet(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');

    // セッション切れ
    if(empty($access_token)) return redirect('timeout');
    
    $tweet = $_POST['tweet'];
    $conection = $this->authenticateAccount($access_token);
    $result = $this->twitter->sendTweet($conection, $tweet);

    $msg = !empty($result->errors) ? $result->errors[0]->message : 'OK';
    return $msg;
  }


}
