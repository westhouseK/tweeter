$(function(){
  // ajax
  $('#tweet').on('click', function(){
    let tweet = $('#text_area').val()
    if (!judge_tweet(tweet)) {
      alert('長いよ〜')
      return
    }

    $.ajax({
      type: 'POST',
      url: '/post',
      data: {
        tweet
      }
    }).done(function(data, textStatus, jqXHR){
      console.log(data)

      if (jqXHR.status === 200 && data !== 'OK') {
        alert(data)
        return
      }
      $('#text_area').val('')
      set_word_count()
      alert('ツイートに成功しました')
    }).fail(function(){
      alert('ツイートに失敗しました')
    })
  })

  // テキストエリアの文字数を常にカウント
  $('#text_area').on('input', function(){
    set_word_count()
  })

  // アイコンがクリックされた時にappend
  $('.copy').on('click', function(){
    $(this).css('color', 'red')
    console.log($(this).prev().prev().find('#hash').text())
    let hash = $(this).prev().prev().find('#hash').text()
    let text = String($('#text_area').val()) + hash
    $('#text_area').val(text)
    set_word_count()
  })

  // 文字数を数える
  function set_word_count() {
    let texts = $('#text_area').val()
    let { weightedLength, valid } = twitter['default'].parseTweet(texts);
    let lengths = Math.floor(weightedLength / 2)
    $('#length').text(lengths)

    // 色変え
    if (weightedLength > 280 ) {
      $('#length').css('color', 'red')
      console.log(valid)
    } else {
      $('#length').css('color', 'black')
    }
  }

  // valid判定関数
  function judge_tweet(tweet) {
    let { valid } = twitter['default'].parseTweet(tweet)
    return valid
  }
})