<?php

namespace models
{
    class Table extends \Phalcon\Mvc\Model
    {
        /**
         * @param $dbname
         * @param $tablename
         *
         * @return mixed
         */
        public function getInfo( $dbname, $tablename )
        {
            //TODO check tablename to be valid table from database ( as it cannot be bind :( )

            //TODO why it doesn't work
            $table_info = $this->getDI()->get('db')->exec(
                [
                    'query' => "SELECT *
                                FROM " . $tablename,
                    'binds' => [],
                    'config'    => array_merge(
                        $this->getDI()->get('user')->getDataForDbConnect(),
                        [
                            'database'  => $dbname
                        ]
                    )
                ]
            );

            return $table_info;
        }
    }
}