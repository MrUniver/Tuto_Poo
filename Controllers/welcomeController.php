<?php
class welcomeController extends  Controller
{

    protected $composants = array(
        'form',
        'session'
    );



    protected $title = 'TutoChat';

    public function connexion()
    {
        $this->title .= ' | Connexion';
        if (isset($_POST) && !empty($_POST)){
            $user = $this->Welcome->isExistUser($_POST['user_name'], $_POST['user_password']);
            if (!empty($user)){
                $this->Session->addKey('User', ['user_name'=>$user->user_name, 'user_id'=>$user->user_id]);
                \Strange\Config\Routeur::redirect('profile');
            }else{
                $this->Session->setFlash("Vous n'êtes pas inscris ou votre compte n'est pas activer", 'danger');
            }
        }
        return $this->render('connexion');
    }

    public function inscription()
    {
        $this->title .= ' | Inscription';
        if ($this->Welcome->validate()){
            $data = $_POST;
            $data['user_register'] = date('Y-m-d H:i:s');
            $data['user_token'] = rand(100, 900). uniqid();
            $data['user_password'] = hash('sha256', $data['user_password']);
            unset($data['user_password_confirm']);
            if ($this->Welcome->save($data)){
                $this->Session->setFlash('Vous êtes inscris, vérifier votre boite email', 'success');
                $headers = 'From: contact@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                $message = "Bonjour Mr/Madame \n, activez votre compte pour vous connecter \n Voici le lien d'activation
                http://127.0.0.1/projects/Tutoriels/POO/confirmtoken-". $data['user_token'].'-'.urlencode($data['user_email']);
                mail($data['user_email'],'Confirmation de compte', $message, $headers);
                \Strange\Config\Routeur::redirect('.');
            }
        }
        return $this->render('inscription');
    }

    public function resetpassword()
    {
        return $this->render('resetpassword');
    }

    /**
     * @param string $token : pour confirmation
     * @param string $email
     */
    public function confirmtoken(string $token, string $email)
    {
        if (isset($token) && filter_var($email, FILTER_VALIDATE_EMAIL)){
            if ($this->Welcome->isUserExist($token, $email)){
                if($this->Welcome->update(['user_email'=>$email, 'user_token'=>$token], ['user_activate'=>1])){
                    $this->Session->setFlash("Votre compte est activez, connectez-vous ", 'success');
                    \Strange\Config\Routeur::redirect('.');
                }
            }
        }else{
            $this->Session->setFlash("Votre compte ne peut pas être activez ", 'danger');
            \Strange\Config\Routeur::redirect('.');
        }
    }

}