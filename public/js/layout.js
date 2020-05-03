$(function(){
  $('.btn').on('click', function(){
    let tweet = $('#text_area').val()

    // alert(tweet)
    $.ajax({
      type: 'POST',
      url: '/post',
      data: tweet
    }).done(function(data){
      const result = JSON.parse(data)
      alert(result.response)
    }).fail(function(){

    })
  })
})