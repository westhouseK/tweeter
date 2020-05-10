$(function(){
  // ajax
  $('#tweet').on('click', function(){
    let tweet = $('#text_area').val()

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
      alert('ツイートに成功しました')
      $('#text_area').text('')
      set_word_count()
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
    let count = Array.from(texts).length
    $('#length').text(count)
  }
})