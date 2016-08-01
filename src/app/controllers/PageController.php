<?php

namespace controllers
{
    /**
     * PageController
     */
    class PageController extends \controllers\BaseController
    {
        ///////////////////////////////////////////////////////////////////////////

        /**
         * PageController::indexAction()
         */
        public function indexAction()
        {
            if( ! $this->user->isAuth() )
            {
                $this->response->redirect( '/login', 302 );

                return false;
            }

            $this->response->redirect( '/' );

            return false;
        }

        ///////////////////////////////////////////////////////////////////////////

        /**
         * PageController::error403Action()
         */
        public function error403Action()
        {
            $this->response->setStatusCode( 403, 'Forbidden' );

            // set title
            $this->getDI()->get('page')->setTitle( $this->getDI()->get('core')->i18n( 'title_error_403' ), true );

            // set vars
            $this->_setVars();
        }

        ///////////////////////////////////////////////////////////////////////////

        /**
         * PageController::error404Action()
         */
        public function error404Action()
        {
            $this->response->setStatusCode( 404, 'Not Found' );

            // set title
            $this->getDI()->get('page')->setTitle( $this->getDI()->get('core')->i18n( 'title_error_404' ), true );

            // set vars
            $this->_setVars();
        }

        ///////////////////////////////////////////////////////////////////////////

        /**
         * PageController::errorCustomAction()
         */
        public function errorCustomAction()
        {
            // set title
            $this->getDI()->get('page')->setTitle( $this->getDI()->get('core')->i18n( 'title_error_custom' ), true );

            // set vars
            $this->_setVars();
        }

        ///////////////////////////////////////////////////////////////////////////
    }
}
