<?php
/**
 * Created by PhpStorm.
 * User: Win7
 * Date: 16/02/2018
 * Time: 23:16
 */

class Welcome extends Model
{
    protected $validates = array(
      'user_name' => array(
          'between'=> '6:15',
          'unique' => 'users'
      ) ,
        'user_email'    => array(
            'email' => true,
        ),
        'user_password' => array(
            'complex'   => true,
            'equal'     => 'user_password_confirm'
        )
    );

    protected $table = 'users';

    /**
     * @param string $token
     * @param string $email
     * @return array|PDOStatement
     */
    public function isUserExist(string $token, string $email)
    {
        return $this->findCurrent(array(
           'conditions' => array(
               'user_email='    => $email,
               'user_token='    => $token,
           ),
            'fields'    => array('user_email', 'user_token')
        ));
    }

    public function isExistUser(string $user_name, string $user_password)
    {
        return $this->findCurrent(array(
                'conditions'    => array(
                    'user_name='     => $user_name,
                    'user_password=' => hash('sha256', $user_password),
                    'user_activate=' => 1
                ),
                'fields'        => array('user_name', 'user_id')
            )
        );
    }

}