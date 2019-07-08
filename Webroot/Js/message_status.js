$(document).ready(function() {
    $('#send_status').click(function() {
        var Validateur = Object.create(Validator)
        var Post = Object.create(Sender)
        var status_text = Validator.getInput('user_humer')
        if (status_text) {
            $.post('./Views/Responses/message_status.php', { message: $('#user_humer').val() }, function(response) {
                $('#message_status').fadeIn(300).html(response.retour).delay(3000).fadeOut(300)
                $('#user_humer').val("")
            }, 'json')
        }

    })
})