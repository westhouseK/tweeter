# raku_raku_tweet

## 注意
現段階ですと, git cloneしても実行できません。

もし、実行したい方は、以下の流れで実行できようになります。
(phpがインストール済みであること)

git clone
↓
config/Consts/twitterauth/phpを作成
↓
ユーザー情報を記入
<?php

return [
  'api_key'             => '',
  'api_secret_key'      => '',
  'access_token'        => '',
  'access_token_secret' => '',
];

?>
↓
ターミナル 
php artisan serve