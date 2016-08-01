<?php

namespace controllers
{
    use models\Db;
    use models\Table;

    /**
     * DbController
     */
    class DbController extends \controllers\BaseController
    {
        /**
         * DbController::indexAction
         */
        public function indexAction()
        {
            if ( $this->request->isPost() )
            {
                if( $this->csrftoken->verify( $this->request->getPost( $this->csrftoken->getKeyName(), 'string', '' ) ) )
                {
                    
                }
                else
                {
                    $this->flash->error($this->core->i18n('csrftoken_error'));
                    return $this->response->redirect( $this->request->getHTTPReferer(), 302);
                }
            }

            $db = new Db();

            $list = $db->getList();

            ///////////////////////////////////////////////////////////////////

            $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);

            $this
                ->assets
                ->collection('css')
            ;

            $this
                ->assets
                ->collection('js')
                ->addJs('js/csrftoken-init.js', true )
                ->addJs('js/layouts/sidebar.js', true )
                ->addJs('js/db/index.js', true )
            ;

            // set title
            $this->page->setTitle( $this->core->i18n('title_db_index'), true);

            // set vars
            $this->_setVars([
                'db_list'   => $list
            ]);
        }

        ///////////////////////////////////////////////////////////////////

        /**
         *
         */
        public function ajaxGetTablesAction()
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

            $dbname = $this->request->getPost( 'db_name', 'string', '' );

            try
            {
                $db  = new Db();

                $table_list = $db->getTableInfo( $dbname, false );
            }
            catch( \Exception $e )
            {
                $table_list = [];
            }
            finally
            {
                // regenerate token
                $this->csrftoken->generate();

                $token = $this->csrftoken->get();
            }
            
            $json =
            [
                'tables_list'       => $table_list,
                'tables_list_view'  => $this->viewHelpers->getDbTables( $dbname, $table_list ),
                'csrftoken'         => $token
            ];

            ///////////////////////////////////////////////////////////////////

            return json_encode( $json );
        }

        ///////////////////////////////////////////////////////////////////
    }
}
