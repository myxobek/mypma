<?php

namespace lib
{
    /**
     * csrftoken
     */
    class csrftoken extends \lib\dependencyInjection
    {
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        private     $keyName            = 'csrftoken';
        private     $token              = '';
        private     $tokenEncrypted     = '';

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::_generate()
         *
         * @return          bool
         */
        public function _storeToSession()
        {
            return
                $this->getDi()->get('session')->set(
                    $this->keyName,
                    array_merge(
                        $this->getDi()->get('session')->get( $this->keyName, [] ),
                        [ $this->token ]
                    )
                );
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::getKeyName()
         *
         * @return          string
         */
        public function getKeyName()
        {
            return $this->keyName;
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::_generate()
         *
         * @return          object
         */
        public function generate()
        {
            $this->token =
                // 3 x md5()
                md5(
                    md5(
                        md5(
                            // generate random string
                            uniqid( mt_rand( 1, 999999999 ), true ) . ' // '. serialize($_SERVER)
                        )
                    )
                );

            // store to session
            $this->_storeToSession();

            $this->tokenEncrypted =
                // reverse a string
                strrev(
                    // base 64
                    base64_encode(
                        // reverse a string
                        strrev(
                            $this->token
                        )
                    )
                );

            // change character case
            $this->tokenEncrypted = strtolower($this->tokenEncrypted) ^ strtoupper($this->tokenEncrypted) ^ $this->tokenEncrypted;

            return $this;
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::getTokenAsHTML()
         *
         * @return          string
         */
        public function getAsHTML()
        {
            return ' data-'.$this->keyName.'="'.$this->tokenEncrypted.'" ';
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::get()
         *
         * @return  string
         */
        public function get()
        {
            return $this->tokenEncrypted;
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /**
         * csrftoken::verify()
         *
         * @param           string      $tokenToCheck
         * @return          bool
         */
        public function verify( $tokenToCheck )
        {
            // get all session tokens
            $sessionTokens = $this->getDi()->get('session')->get( $this->keyName, [] );

            if( in_array( $tokenToCheck, $sessionTokens ) )
            {
                // remove from array
                $sessionTokens = array_flip($sessionTokens);
                unset( $sessionTokens[$tokenToCheck] );
                $sessionTokens = array_flip($sessionTokens);

                // update session tokens
                $this->getDi()->get('session')->set( $this->keyName, $sessionTokens );

                return true;        // OK
            }

            return false;
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    }
}