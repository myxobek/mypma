<?php

namespace controllers
{
    use models\Table;

    /**
     * TableController
     */
    class TableController extends \controllers\BaseController
    {
        /**
         * TableController::indexAction
         */
        public function indexAction()
        {

        }

        ///////////////////////////////////////////////////////////////////

        /**
         * @return string
         */
        public function ajaxGetAction()
        {
            if ( !$this->request->isAjax() || !$this->request->isPost() )
            {
                die('[1]');
            }

            ///////////////////////////////////////////////////////////////////

            if( !$this->csrftoken->verify( $this->request->getPost( $this->csrftoken->getKeyName(), 'string', '' ) ) )
            {
                die('[2]');
            }

            ///////////////////////////////////////////////////////////////////

            $json = [];

            $dbname     = $this->request->getPost( 'db_name', 'string', '' );
            $table_name = $this->request->getPost( 'table_name', 'string', '' );

            try
            {
                $table  = new Table();

                $table_info = $table->getInfo( $dbname, $table_name );
            }
            catch( \Exception $e )
            {
                $table_info = [];
            }
            finally
            {
                // regenerate token
                $this->csrftoken->generate();

                $token = $this->csrftoken->get();
            }

            $json =
                [
                    'table_info'    => $this->viewHelpers->getTableInfo( $table_name, $table_info ),
                    'csrftoken'     => $token
                ];

            ///////////////////////////////////////////////////////////////////

            return json_encode( $json );
        }

    }
}
