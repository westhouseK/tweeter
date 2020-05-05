$(function(){
  $('#tweet').on('click', function(){
    let tweet = $('#text_area').val()

    // alert(tweet)
    $.ajax({
      type: 'POST',
      url: '/post',
      data: {
        tweet
      }
    }).done(function(data, textStatus, textStatus){
      // const result = JSON.parse(data)
      console.log(textStatus);
      console.log(textStatus);

      alert(data)
    }).fail(function(){
    })
  })

  // テキストエリアの文字数を数える
  $('#text_area').keyup(function(){
    let texts = $(this).val()
    let count = Array.from(texts).length
    $('#length').text(count)
  })

  // アイコンがクリックされた時にappend
  $('.copy').on('click', function(){
    $(this).css('color', 'red')
    let hash = $(this).prev().find('#hash').text()
    console.log($(this).prev().find('#hash').text())

    let text = String($('#text_area').val())
    console.log(text)
    $('#text_area').val(text + hash)

  })
})