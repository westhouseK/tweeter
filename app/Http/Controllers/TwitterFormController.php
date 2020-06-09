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

  /**
   *  アプリのメイン画面を表示
   *  @param  $request
   *  @return
   */
  public function showForm(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');

    // セッション切れ
    if(empty($access_token)) return redirect('timeout');

    $conection = $this->authenticateAccount($access_token);
    $data = $this->twitter->getTwitterInfo($conection);

    return view('twitter_form', compact('data'));
  }

  /**
   *  タイムアウト画面
   *  @return
   */
  public function showTimeout()
  {
    return view('timeout');
  }

  /**
   *  アプリの説明画面
   *  @return
   */
  public function showAbout()
  {
    return view('about');
  }

  /**
   *  ajaxでツイートを送信
   *  @param  $request
   *  @return
   */
  public function postTweet(Request $request)
  {
    $access_token = $request->session()->get('twAccessToken');

    // セッション切れ
    if(empty($access_token)) return 'セッション切れです';
    
    $tweet     = $_POST['tweet'];
    $conection = $this->authenticateAccount($access_token);
    $result    = $this->twitter->sendTweet($conection, $tweet);

    $msg = !empty($result->errors) ? $result->errors[0]->message : 'OK';
    return $msg;
  }
}
