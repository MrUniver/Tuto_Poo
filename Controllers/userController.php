<?php
class userController extends Controller {

	public $title = 'Programmation Orientée Objet';
	protected $template = 'home';

    protected $composants = array(
		'form',
        'session'
	);

    public function index()
    {
        $me = $this->Session->getKey('User');
        $user   = $this->User->getMe($me['user_id']);
        return $this->render('home', compact('me', 'user'));
    }

    public function logout()
    {
        unset($_SESSION['User']);
        \Strange\Config\Routeur::redirect('.');
    }
}