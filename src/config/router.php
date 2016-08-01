<?php

$router = new \Phalcon\Mvc\Router( false );

$router->setDefaults(
    [
        'controller'    => 'page',
        'action'        => 'index'
    ]);

$router->notFound(
    [
        'controller'    => 'page',
        'action'        => 'error404'
    ]);

$router->removeExtraSlashes(true);

$router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_GET_URL);

// auth ///////////////////////////////////////////////////////////////////////

$router
    ->add('/login',
        [
            'controller'    => 'auth',
            'action'        => 'login'
        ])
    ->via( [ 'GET', 'POST' ] )
    ->setName( 'auth_login' );

$router
    ->add('/logout',
        [
            'controller'    => 'auth',
            'action'        => 'logout'
        ])
    ->via( [ 'GET' ] )
    ->setName( 'auth_logout' );

// db ////////////////////////////////////////////////////////////////////////

$router
    ->add('/db/ajax/get/tables',
        [
            'controller'    => 'db',
            'action'        => 'ajaxGetTables'
        ])
    ->via( [ 'POST' ] )
    ->setName( 'db_ajax_get_tables' );

// table //////////////////////////////////////////////////////////////////////

$router
    ->add('/table/ajax/get',
        [
            'controller'    => 'table',
            'action'        => 'ajaxGet'
        ])
    ->via( [ 'POST' ] )
    ->setName( 'table_ajax_get' );

// homepage ///////////////////////////////////////////////////////////////////

$router
    ->add('/',
        [
            'controller'    => 'db',
            'action'        => 'index'
        ])
    ->setName( 'homepage' );

return $router;