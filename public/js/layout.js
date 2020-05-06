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
      $('#text_area').val('')
      // 関数を切る
      let count = Array.from(tweet).length
      $('#length').text(count)
    }).fail(function(){
      alert('ツイートに失敗しました')
    })
  })

  // テキストエリアの文字数を常にカウント
  $('#text_area').on('input', function(){
    let texts = $(this).val()
    let count = Array.from(texts).length
    $('#length').text(count)
  })

  // アイコンがクリックされた時にappend
  $('.copy').on('click', function(){
    // $(this).css('color', 'red')
    let hash = $(this).prev().find('#hash').text()
    let text = String($('#text_area').val()) + hash
    $('#text_area').val(text)
    let count = Array.from(text).length
    $('#length').text(count)
  })
})