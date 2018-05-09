<div class="col-sm-8" style="margin: 0 auto">
    <?= $this->Form->create('myformconnexion') ?>
    <?= $this->Form->input('user_name', 'Met ton prenom') ?>
    <?= $this->Form->input('user_password', 'Met ton mot de passe', ['type'=>"password"]) ?>
    <?= $this->Form->end('Envoyer') ?>
</div>