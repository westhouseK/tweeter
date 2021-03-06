<?php

namespace App;
require base_path('vendor/autoload.php');

use Illuminate\Database\Eloquent\Model;

class Twitterapi extends Model
{
  public function __construct()
  {
    $this->api_key        = config('Consts.twitterauth.api_key');
    $this->api_secret_key = config('Consts.twitterauth.api_secret_key');
  }

  /**
   *  画面に表示するデータを取得
   *  @param  $conection
   *  @return array
   */
  public function getTwitterInfo($connection)
  {
    $twitter_info = [];

    $account_info            = $this->getAccountInfo($connection);
    $twitter_info['name']    = $account_info->name;
    $twitter_info['profile'] = $account_info->profile_image_url_https;

    $tweets   = $this->getTweet($connection, 200);
    $hashtags = $this->filterHashtags($tweets);
    $twitter_info['rank'] = $this->getTopHashtags($hashtags);

    return $twitter_info;
  }

  /**
   *  Twitter APIを叩く
   *  @param  $conection
   *  @param  $tweet
   *  @return array
   */
  public function sendTweet($conection, $tweet)
  {
    return $this->postTweet($conection, $tweet); 
  }

  /**
   *  ユーザ情報の取得
   *  @param  $conection
   *  @return object
   */
  private function getAccountInfo($connection)
  {
    return $connection->get("account/verify_credentials");
  }

  /**
   *  ツイートを取得
   *  @param  $conection
   *  @param  $count (Max 200)
   *  @return array
   */
  private function getTweet($connection, $count)
  {
    return $connection->get('statuses/user_timeline', ['count' => $count]);
  }

  /**
   *  ツイートをpostする
   *  @param  $conection
   *  @param  $tweet
   *  @return array
   */
  private function postTweet($conection, $tweet)
  {
    return $conection->post('statuses/update', ['status' => $tweet]);
    // return 'dummy';
  }

  /**
   * ツイートからハッシュタグを抽出
   *  @param  $tweets
   *  @return $hashtags
   */
  private function filterHashtags($tweets) {

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

  /**
   * ハッシュタグの中から、上位のハッシュダグを抽出
   *  @param  $hashtags
   *  @param  $rank
   *  @return $rank_hashtags
   */
  private function getTopHashtags($hashtags, $rank = 3) 
  {
    if (empty($hashtags)) return null;

    // ハッシュタグを集計
    $count_hashtags = array_count_values($hashtags);
    arsort($count_hashtags);

    // 上位3つまでを抽出
    $rank_hashtags = array_slice($count_hashtags, 0, $rank);
    return array_keys($rank_hashtags);
  }
}
