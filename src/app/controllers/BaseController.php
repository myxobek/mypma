<?php

namespace controllers
{
    /**
     * BaseController
     */
    class BaseController extends \Phalcon\Mvc\Controller
    {
        ///////////////////////////////////////////////////////////////////////////

        protected $currentControllerAction = '';

        ///////////////////////////////////////////////////////////////////////////

        /**
         * BaseController::beforeExecuteRoute()
         *
         * @return      mixed
         */
        public function beforeExecuteRoute()
        {
            $this->currentControllerAction = join(
                '/',
                [
                    $this->dispatcher->getControllerName(),
                    $this->dispatcher->getActionName()
                ]
            );

            if(
                ! in_array(
                    $this->currentControllerAction,
                    [
                        // page
                        'page/index',
                        'page/error403',
                        'page/error404',
                        'page/errorCustom',
                        // auth
                        'auth/login',
                        'auth/logout',
                    ]
                )
            )
            {
                if( ! $this->user->isAuth() )
                {
                    if( $this->request->isAjax() )
                    {
                        die( '[]' );
                    }
                    else
                    {
                        $this->response->redirect( '/login', 302 );
                        return false;
                    }
                }
            }
        }

        ///////////////////////////////////////////////////////////////////////////

        /**
         * BaseController::initialize()
         */
        public function initialize()
        {
            $this
                ->assets
                ->collection('css')
                ->addCss('css/bootstrap.min.css', true)
                ->addCss('css/bootstrap-theme-extended.css', true)
            ;

            $this
                ->assets
                ->collection('js')
                ->addJs('js/jquery-1.11.3.js', true)
                ->addJs('js/bootstrap.min.js', true)
                ->addJs('js/jquery.base64.js', true)
                ->addJs('js/csrftoken.js', true )
            ;
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * BaseController::_setVars()
         *
         * @param       array       $vars
         * @return      mixed
         */
        protected function _setVars( $vars = [] )
        {
            $_page        = $this->getDI()->get('page');

            $this->view->setVars(
                array_merge(
                    [
                        'page'                  => $_page,
                        'page_title'            => $_page->getTitle(),
                    ],
                    $vars
                )
            );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}