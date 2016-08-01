<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1><?= $this->getDi()->get('config')->get('global/title/' . LANG_ALIAS) ?></h1>
        </div>
    </div>
    <?= $this->flash->output() ?>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active" id="login-form-link"><?= $this->core->i18n('auth_login_title') ?></a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form <?= $this->csrftoken->generate()->getAsHTML() ?> id="login-form" action="" method="post" role="form" style="display: block;">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="<?= $this->core->i18n('auth_login_name') ?>" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwd" id="passwd" tabindex="2" class="form-control" placeholder="<?= $this->core->i18n('auth_login_passwd') ?>">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="<?= $this->core->i18n('auth_login_btn_login') ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>