<?php
if($_POST && isset($_POST['message']) && !empty($_POST['message'])){
    session_start();
    $messages = [];
    require_once '../../Models/Model.php';
    $database = new Model();
    $data['status_message'] = trim($_POST['message']);
    $data['status_user_id'] = $_SESSION['User']['user_id'];
    $req = $database->getTable('status')->save($data);
    if($req){
        $messages['retour'] =  '<div class="alert alert-success">Mes</div>';
    }else{
        $messages['retour'] =  '<div class="alert alert-danger">Pro</div>';
    }

}
echo json_encode($messages);