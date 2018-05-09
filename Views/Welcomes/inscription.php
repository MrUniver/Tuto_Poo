<div class="col-sm-8" style="margin: 0 auto">
    <?= $this->Form->create('myforminscription') ?>
    <?= $this->Form->input('user_name', 'Met ton prenom') ?>
    <?= $this->Form->input('user_email', 'Met ton adresse email') ?>
    <?= $this->Form->input('user_password', 'Mettez votre mot de passe', ['type'=>"password"]) ?>
    <?= $this->Form->input('user_password_confirm', 'confirmez votre mot de passe', ['type'=>"password"]) ?>
    <?=  $this->Form->select('user_sexe', ['0' => 'femme', '1'=> 'homme'], 'Quel(le) genre tu es')?>
    <?= $this->Form->end('envoyer') ?>
</div>