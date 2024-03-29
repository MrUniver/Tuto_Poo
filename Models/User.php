<?php
/**
 * Created by PhpStorm.
 * User: Win7
 * Date: 21/01/2018
 * Time: 19:52
 */

class User extends Model
{
    protected $validates  =array(
      'prenom' => array(
          'minlength' => 6,
          'maxlength' => 15
      ),
        'password' => array(
            'complex' => true,
            'minlength' => 10,
            'maxlength' => 20
        )
    );

    public function getMe(string $key)
    {
        return $this->findCurrent(array(
           'conditions' => array(
               'user_id='   => $key
           )
        ));
    }

    public function getUsers()
    {
        return $this->find(array(
            'fields'=> array('user_name', 'user_password'),
        ));
    }

}