<?php

namespace lib
{
    /**
     * viewHelpers Class
     */
    class viewHelpers extends \Phalcon\Tag
    {
        /**
         * @param   string  $dbname
         * @param   array   $tables_list
         *
         * @return  string
         */
        public function getDbTables( $dbname, $tables_list )
        {
            $keys_array = [
                'table_name',
                'Engine',
                'Version',
                'Row_format',
                'table_rows',
                'Avg_row_length',
                'Data_length',
                'Max_data_length',
                'Index_length',
                'Data_free',
                'Auto_increment',
                'Create_time',
                'Update_time',
                'Check_time',
                'table_collation',
                'Checksum',
                'Create_options',
                'table_comment',
            ];

            $tmp =
                '<div id="main">
                    <div class="col-md-12">
                        <h3>' . $dbname . '</h3>
                        <table class="table table-condensed table-stripped js-has-dbname" data-db="' . $dbname . '">
                            <thead>
                                <tr>';
            foreach ( $keys_array as $key )
            {
                $tmp .=
                    '<th>' . $key . '</th>';
            }

            $tmp .=
                                '</tr>
                            </thead>
                            <tbody>';

            for( $i = 0, $n = count( $tables_list ); $i < $n; ++$i )
            {
                $tmp .=
                    '<tr>';
                foreach ( $keys_array as $key )
                {
                    $tmp .=
                        '<td>';

                    if ( $key == 'table_name' )
                    {
                        $tmp .=
                            '<a href="#" class="js-table-open" data-table="' . $tables_list[$i][$key] . '">' .
                                $tables_list[$i][$key] .
                            '</a>';
                    }
                    else
                    {
                        $tmp .=
                            $tables_list[$i][$key];
                    }

                    $tmp .=
                        '</td>';
                }
                $tmp .=
                    '</tr>';
            }

            $tmp .=
                            '</tbody>
                        </table>
                    </div>
                </div>';

            return $tmp;
        }

        ///////////////////////////////////////////////////////////////////

        /**
         * @param   string  $tablename
         * @param   array   $table_info
         *
         * @return  string
         */
        public function getTableInfo( $tablename, $table_info )
        {
            //TODO
            return '';
        }
    }
}