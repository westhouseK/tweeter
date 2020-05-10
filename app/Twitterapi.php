<?php

namespace App;
require base_path('vendor/autoload.php');

use Illuminate\Database\Eloquent\Model;
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitterapi extends Model
{
  public function __construct()
  {
    $this->api_key             = config('Consts.twitterauth.api_key');
    $this->api_secret_key      = config('Consts.twitterauth.api_secret_key');
    $this->access_token        = config('Consts.twitterauth.access_token');
    $this->access_token_secret = config('Consts.twitterauth.access_token_secret');
  }

  public function getTwitterInfo()
  {
    $twitter_info = [];
    $twitter_info['name'] = 'うえすと';

    $twitter = $this->authenticateAccount();
    $tweets = $this->getTweet($twitter);
    $hashtags = $this->filterHashtags($tweets);
    $twitter_info['rank'] = $this->getTopHashtags($hashtags);

    return $twitter_info;
  }

  public function sendTweet($tweet)
  {
    $twitter = $this->authenticateAccount();
    $result = $this->postTweet($tweet, $twitter);
    return $result;
  }

  private function authenticateAccount ()
  {

    $twitter = new TwitterOAuth($this->api_key, 
                                $this->api_secret_key, 
                                $this->access_token, 
                                $this->access_token_secret);
    return $twitter;
  }

  private function getTweet($twitter)
  {
    return $twitter->get('statuses/user_timeline', ['count' => 200]);
  }

  private function filterHashtags($tweets) {
    // Todo: array_filterを使いたい
    $user_hashtags = [];
    foreach($tweets as $tweet) {
      // ハッシュタグを変数に格納
      $user_hashtags = $tweet->entities->hashtags;
      // ツイートにハッシュタグがあるか判定
      if (is_null($user_hashtags)) continue;
      // ハッシュダグを配列に格納
      foreach($user_hashtags as $hashtag) {
        $hashtags[] = $hashtag->text;
      } 
    }
    return $hashtags;
  }


  private function getTopHashtags($hashtags, $rank = 3) {
    if (empty($hashtags)) return null;

    // ハッシュタグを集計
    $count_hashtags = array_count_values($hashtags);
    arsort($count_hashtags);

    // 上位3つまでを抽出
    $rank_hashtags = array_slice($count_hashtags, 0, $rank);
    return array_keys($rank_hashtags);
  }

  private function postTweet($tweet, $twitter)
  {
    $result = $twitter->post('statuses/update', ['status' => $tweet]);
    return $result;
  }
}
