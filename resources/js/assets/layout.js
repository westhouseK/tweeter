$(function(){
  // ajax
  $('#tweet').on('click', function(){
    let tweet = $('#text_area').val()

    if (tweet === '') {
      show_modal("ツイートを入力してください")
      return
    }

    if (!judge_tweet(tweet)) {
      show_modal("ツイートが長すぎます")
      return
    }
    
    $("#overlay").fadeIn(500)

    $.ajax({
      type: 'POST',
      url: '/post',
      data: { tweet }
    }).done(function(data, textStatus, jqXHR){

      if (jqXHR.status === 200 && data !== 'OK') {
        show_modal(data)
        return
      }

      $('#text_area').val('')
      set_words_count()
      show_modal("ツイートに成功しました")
    }).fail(function(){
      show_modal("ツイートに失敗しました")
    }).always(function(){
      $("#overlay").fadeOut(500);
    })
  })

  // テキストエリアの文字数を常にカウント
  $('#text_area').on('input', function(){
    set_words_count()
  })

  // アイコンがクリックされた時にappend
  $('.copy').on('click', function(){
    let hash = $(this).prev().prev().find('#hash').text()
    let text = String($('#text_area').val()) + hash
    $('#text_area').val(text)
    set_words_count()
  })

  // 文字数を数える
  let set_words_count = function(){
    let texts = $('#text_area').val()
    let { weightedLength } = twitter['default'].parseTweet(texts);
    let lengths = Math.floor(weightedLength / 2)
    $('#length').text(lengths)

    // 色変え
    let color = weightedLength > 280 ? 'red' : 'black'
    $('#length').css('color', color)
  }

  // valid判定関数
  function judge_tweet(tweet) {
    let { valid } = twitter['default'].parseTweet(tweet)
    return valid
  }

  // modalを表示
  function show_modal(content) {
    $('#modal-body').html(content)
    $('#modal').modal('show')
  }
})