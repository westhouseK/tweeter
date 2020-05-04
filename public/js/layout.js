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

  $('#text_area').keyup(function(){
    let texts = $(this).val()
    let count = Array.from(texts).length
    $('#length').text(count)
  })
})