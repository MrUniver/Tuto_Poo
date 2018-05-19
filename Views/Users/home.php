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
<div style="display: inline-block; border:1px solid red; padding:10px;">
    <h3>Mets ton humeur du jour</h3>
    <textarea name="user_humer" id="user_humer" class="form-control" style="outline:none;"></textarea><br>
    <button class="btn btn-primary btn-lgt" style="float: left;">Envoyer</button>
</div>