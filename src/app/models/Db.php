<?php

namespace models
{
    class Db extends \Phalcon\Mvc\Model
    {
        /**
         * @return  array
         */
        public function getList()
        {
            $db_list = $this->getDI()->get('db')->exec(
                [
                    'query'     => 'SHOW DATABASES',
                    'binds'     => [],
                    'config'    => $this->getDI()->get('user')->getDataForDbConnect()
                ]
            );

            $result = [];

            foreach ( $db_list as $item )
            {
                $result[ $item['Database'] ] = $this->getTableList( $item['Database'] );
            }

            return $result;
        }

        ///////////////////////////////////////////////////////////////////

        /**
         * @param   string  $dbname
         *
         * @return  array
         */
        public function getTableList( $dbname )
        {
            $table_list = $this->getDI()->get('db')->exec(
                [
                    'query' => "SELECT TABLE_NAME
                                 FROM information_schema.TABLES
                                 WHERE 
                                  TABLE_SCHEMA = :dbname",
                    'binds' => [
                        ':dbname'   => $dbname
                    ],
                    'config'    => array_merge(
                        $this->getDI()->get('user')->getDataForDbConnect(),
                        [
                            'database'  => $dbname
                        ]
                    )
                ]
            );

            $result = [];

            foreach( $table_list as $row )
            {
                $result[] = $row['TABLE_NAME'];
            }

            return $result;
        }

        ///////////////////////////////////////////////////////////////////

        /**
         * Returns info about table, if table_name is not specified - returns info about all tables
         *
         * @param   string  $database
         * @param   bool    $table_name
         */
        public function getTableInfo( $database, $table_name = false )
        {
            $where_clause = '';
            $binds        = [];

            if ( $table_name !== false )
            {
                $where_clause           = " AND table_name = :table_name";
                $binds[':table_name']   = $table_name;
            }

            $table_info = $this->getDI()->get('db')->exec(
                [
                    'query' => "SELECT table_name,Engine,Version,Row_format,table_rows,Avg_row_length,
                                Data_length,Max_data_length,Index_length,Data_free,Auto_increment,
                                Create_time,Update_time,Check_time,table_collation,Checksum,
                                Create_options,table_comment 
                                FROM information_schema.tables
                                WHERE table_schema = :table_schema" . $where_clause,
                    'binds' => array_merge(
                        $binds,
                        [
                            'table_schema' => $database
                        ]
                    ),
                    'config' => array_merge(
                        $this->getDI()->get('user')->getDataForDbConnect(),
                        [
                            'database'  => $database
                        ]
                    )
                ]
            );

            return $table_info;
        }
    }
}