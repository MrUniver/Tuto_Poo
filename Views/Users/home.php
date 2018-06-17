<div style="display: inline-block; border:1px solid red;">
    <div class="card">
        <div class="card-header"><div class="card-title"><?= $user->user_name ?></div></div>
        <div class="card-body">
            <img src="http://via.placeholder.com/350x350" alt="">
                <table class="table table-dark">
                    <tr>
                        <td>Votre nom de famille</td>
                        <td><?= $user->user_name ?></td>
                    </tr>
                    <tr>
                        <td>Votre email</td>
                        <td><?= $user->user_name ?></td>
                    </tr>
                    <tr>
                        <td>Votre age</td>
                        <td>Votre Prénom</td>
                    </tr>
                </table>
        
        </div>
    </div>
</div>
<div style="display:grid; border:1px solid red; padding:10px;grid-template-rows:1fr 3fr;grid-row-gap:1rem">
    <div class="header">
        <h3>Mets ton humeur du jour</h3>
        <span id="message_status"></span>
        <textarea name="user_humer" id="user_humer" class="form-control" style="outline:none;"></textarea><span id="help-user_humer"></span><br>

        <button class="btn btn-primary btn-lgt" style="float: left;" id="send_status">Envoyer</button>
    </div>
    <div class="message" style="text-align: left; border:1px solid red">
        <div class="message_box" style="display: grid;grid-template-rows:1fr 2fr;padding:5px;">
            <div class="message_header">
                <span class="message_pseudo" style="text-align: left;">
                    Moi et Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, quam!
                </span>
                <span class="message_date" style="text-align: right;float: right;">
                    aujo
                </span>
            </div>

            <div class="message_text">
                message
            </div>

        </div>
    </div>
</div>