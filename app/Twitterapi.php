<?php

namespace App;
require base_path('vendor/autoload.php');

use Illuminate\Database\Eloquent\Model;

class Twitterapi extends Model
{
  public function __construct()
  {
    $this->api_key         = config('Consts.twitterauth.api_key');
    $this->api_secret_key  = config('Consts.twitterauth.api_secret_key');
  }

  public function getTwitterInfo($connection)
  {
    $twitter_info = [];
    $twitter_info['name'] = $connection->get("account/verify_credentials")->name;
    $twitter_info['profile'] = $connection->get('account/verify_credentials', ['tweet_mode' => 'extended', 'include_entities' => 'true'])->profile_image_url_https;

    $tweets   = $this->getTweet($connection);
    $hashtags = $this->filterHashtags($tweets);
    $twitter_info['rank'] = $this->getTopHashtags($hashtags);

    return $twitter_info;
  }

  public function sendTweet($conection, $tweet)
  {
    return $this->postTweet($conection, $tweet); 
  }

  private function getTweet($connection)
  {
    return $connection->get('statuses/user_timeline', ['count' => 200]);
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

  private function postTweet($conection, $tweet)
  {
    return $conection->post('statuses/update', ['status' => $tweet]);
  }
}
