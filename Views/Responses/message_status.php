<?php
if($_POST && isset($_POST['message']) && !empty($_POST['message'])){
    session_start();
    $messages = [];
    require_once '../../Models/Model.php';
    $database = new Model();
    $data['status_message'] = trim(htmlspecialchars($_POST['message']));
    $data['status_user_id'] = intval($_SESSION['User']['user_id']);
    $req = $database->getTable('status')->save($data);
    if($req){
        $messages['retour'] =  '<div class="alert alert-success">Votre message a bien été posté</div>';
    }else{
        $messages['retour'] =  '<div class="alert alert-danger">Votre message n\'a pas été posté</div>';
    }

}
echo json_encode($messages);