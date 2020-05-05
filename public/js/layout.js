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
      console.log(textStatus);
      console.log(jqXHR);
      console.log(jqXHR.status);

      if (jqXHR.status !== 200) {
        alert('ツイートに失敗しました')
        return
      }
      alert('ツイートに成功しました')
      $('#text_area').val('')
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
    console.log(text)
    $('#text_area').val(text)
  })
})