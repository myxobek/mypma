<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="title" content="<?= $page_title ?>" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title><?= $page_title ?></title>
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon">
    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <?php
        $this->assets->outputCss( 'css' );
        $this->assets->outputJs( 'js' );
    ?>
</head>
<body>
<?php
    if ( $this->user->isAuth() )
    {
        echo(
            '<input type="hidden" ' . $this->csrftoken->generate()->getAsHTML() . ' id="csrftoken">'
        );

        $this->partial('layouts/navbar');

        echo('<div class="row-offcanvas row-offcanvas-left" id="page">');

        $this->partial('layouts/sidebar');
    }

        echo( $this->getContent() );

    if ( $this->user->isAuth() )
    {
        echo('</div>');
    }
?>
</body>
</html>
