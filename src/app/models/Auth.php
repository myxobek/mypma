<?php

namespace models
{
    class Auth extends \Phalcon\Mvc\Model
    {
        /**
         * @param   $username
         * @param   $password
         *
         * @return  boolean
         */
        public function login($username, $password)
        {
            if ( strlen($username) >= 1 && strlen($password) >= 1 )
            {
                $db = $this->getDI()->get('db')->getConnection(
                    [
                        'username' => $username,
                        'password' => $password,
                    ]
                );

                return !!$db;
            }
            else
            {
                return false;
            }
        }

        ///////////////////////////////////////////////////////////////////
    }
}