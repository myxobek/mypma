<?php

namespace lib
{
    /**
     * user Class
     */
    class user extends \lib\dependencyInjection
    {
        /**
         * user::isAuth
         *
         * @return          bool
         */
        public function isAuth()
        {
            if( $this->getDi()->get('session')->has('is_auth') && $this->getDi()->get('session')->get('is_auth') )
            {
                return true;
            }

            return false;
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * user::getSessionId
         *
         * @return          integer
         */
        public function getSessionId()
        {
            return $this->getDi()->get('session')->getId();
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * @return array
         */
        public function getDataForDbConnect()
        {
            return [
                'username'  => $this->getDi()->get('session')->get('username'),
                'password'  => $this->getDi()->get('session')->get('password')
            ];
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * user::setVars
         *
         * @param           array       $data
         * @return          bool
         */
        public function setVars( $data )
        {
            if( empty($data) || !is_array($data) )
            {
                return false;
            }

            foreach( $data as $key => $value )
            {
                $this->getDi()->get('session')->set( $key, $value );
            }

            return true;
        }

        ///////////////////////////////////////////////////////////////////////
    }
}