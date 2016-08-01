<?php

namespace lib
{
    /**
     * db
     */
    class db extends \lib\dependencyInjection
    {
        /**
         * db::getConnection()
         *
         * @param   array   $config
         * @param   bool    [$is_debug = false]
         *
         * @return    \PDO
         */
        public function getConnection( $config = [], $is_debug = false )
        {
            $default_config = $this->getDi()->get('config')->get('global/database');

            if ( $is_debug )
            {
                p([
                    'host'      => ( $this->_arrayKeySuits('host', $config )     ? $config['host']       : $default_config['host'] ),
                    'port'      => ( $this->_arrayKeySuits('port', $config )     ? $config['port']       : $default_config['port'] ),
                    'username'  => ( $this->_arrayKeySuits('username', $config ) ? $config['username']   : $default_config['username'] ),
                    'password'  => ( $this->_arrayKeySuits('password', $config ) ? $config['password']   : $default_config['password'] ),
                    'database'  => ( $this->_arrayKeySuits('database', $config ) ? $config['database']   : $default_config['database'] ),
                    'options'   => []
                ]);
            }

            $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(
                [
                    'host'      => ( $this->_arrayKeySuits('host', $config )     ? $config['host']       : $default_config['host'] ),
                    'port'      => ( $this->_arrayKeySuits('port', $config )     ? $config['port']       : $default_config['port'] ),
                    'username'  => ( $this->_arrayKeySuits('username', $config ) ? $config['username']   : $default_config['username'] ),
                    'password'  => ( $this->_arrayKeySuits('password', $config ) ? $config['password']   : $default_config['password'] ),
                    'database'  => ( $this->_arrayKeySuits('database', $config ) ? $config['database']   : $default_config['database'] ),
                    'options'   => []
                ]
            );

            return $connection;
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * @param   string  $key
         * @param   array   $array
         *
         * @return  bool
         */
        private function _arrayKeySuits( $key, $array )
        {
            return ( ( array_key_exists($key, $array ) ) && ( strlen( $array[$key] ) > 0 ) );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * db::exec()
         *
         * @param     string    $data
         *
         * @return    array|bool
         */
        public function exec( $data, $is_debug = false )
        {
            $query  = isset( $data['query'] )    ? $data['query']    : '';
            $binds  = isset( $data['binds'] )    ? $data['binds']    : [];
            $config = isset( $data['config'] )   ? $data['config']   : [];

            ///////////////////////////////////////////////////////////////////////

            $connection = $this->getConnection( $config, $is_debug );

            $stmt = $connection->prepare( $query );
            foreach ($binds as $key => $value )
            {
                $stmt->bindValue( $key, $value);
            }
            $stmt->setFetchMode(\Phalcon\Db::FETCH_ASSOC);

            $stmt->execute();

            ///////////////////////////////////////////////////////////////////////

            return $stmt->fetchAll();
        }
    }
}
