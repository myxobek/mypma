<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?= $this->getDi()->get('config')->get('global/title/' . LANG_ALIAS) ?></a>
    </div>
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <!--<li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>-->
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li><a href="/logout"><?= $this->core->i18n('sidebar_auth_logout') ?></a></li>
        </ul>
    </div><!--/.nav-collapse -->
</div>