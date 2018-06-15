$(document).ready(function () {
    $('#send_status').click(function () {
        var Validateur  = Object.create(Validator)
        var Post      = Object.create(Sender)
        var status_text = Validator.getInput('user_humer')
        console.log(Post)
        if (status_text){
            $.post('./Views/Responses/message_status.php', {message: $('#user_humer').val()}, function (response) {
                $('#message_status').fadeIn(300).html(response.retour).delay(3000).fadeOut(300)
                console.log(response)
            },'json')
        }

    })
})
/**
 debugger
 if($('#user_humer').val() !=="" && $('#user_humer').val().length > 1 ){
            $.post('./Views/Responses/message_status.php', {message: $('#user_humer').val()}, function (response) {
                $('h3').html(response)
                console.log(response)
                alert(response)
            })
        }
 Post.send('message_status',{message:$('#user_humer').val()}, function (data) {
               console.log(data)
           })
 **/