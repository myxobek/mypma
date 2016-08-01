<?php

namespace controllers
{

    use models\Auth;

    /**
     * AuthController
     */
    class AuthController extends \controllers\BaseController
    {
        /**
         * AuthController::loginAction
         */
        public function loginAction()
        {
            ///////////////////////////////////////////////////////////////////

            if ( $this->user->isAuth() )
            {
                return $this->response->redirect('/', 302);
            }

            ///////////////////////////////////////////////////////////////////

            if ( $this->request->isPost() )
            {
//                if( $this->csrftoken->verify( $this->request->getPost( $this->csrftoken->getKeyName(), 'string', '' ) ) )
//                {
                    $name = preg_replace('#[^0-9a-z\_]#', '', $this->request->getPost('name', 'string', ''));
                    $passwd = trim($this->request->getPost('passwd', 'string', ''));

                    $auth = new Auth();

                    if ( $auth->login($name, $passwd) === true )
                    {
                        //TODO remember db's that user has access to
                        $this->user->setVars(
                            [
                                'username'  => $name,
                                'password'  => $passwd,
                                'is_auth'   => 1
                            ]
                        );

                        return $this->response->redirect('/', 302);
                    }
                    else
                    {
                        $this->flash->error($this->core->i18n('auth_login_error_400'));
                        return $this->response->redirect('/login', 302);
                    }
//                }
//                else
//                {
//                    $this->flash->error($this->core->i18n('csrftoken_error'));
//                    return $this->response->redirect('/login', 302);
//                }
            }

            ///////////////////////////////////////////////////////////////////

            $this
                ->assets
                ->collection('css')
                ->addCss('css/auth/login.css', true)
            ;

            $this
                ->assets
                ->collection('js')
                ->addJs('js/csrftoken-init.js')
            ;

            // set title
            $this->page->setTitle($this->core->i18n('title_auth_login'), true);

            // set vars
            $this->_setVars();
        }

        ///////////////////////////////////////////////////////////////////

        /**
         * AuthController::logoutAction
         *
         * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
         */
        public function logoutAction()
        {
            if (!$this->user->isAuth())
            {
                $this->response->redirect('/login', 302);
                return false;
            }

            // destroy user session
            $this->session->destroy();

            // unset $_SESSION, regenerate SID
            session_unset();
            session_regenerate_id(true);

            $this->response->redirect('/', 302);
            return false;
        }
    }
}
