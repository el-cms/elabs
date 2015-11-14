<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset() ?>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="initial-scale=1.0, width=device-width" name="viewport">
        <title>
            <?php echo $this->fetch('title') . ' &#150; ' . Cake\Core\Configure::read('cms.siteName') ?>
        </title>
        <?php echo $this->Html->meta('icon') ?>

        <?php echo $this->Html->css('backend.css', array('media' => 'screen,projection')) ?>

        <?php echo $this->fetch('meta') ?>
        <?php echo $this->fetch('css') ?>
        <?php echo $this->fetch('script') ?>

        <!-- ie -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-red avoid-fout">
        <?php echo $this->element('layout/pageloader') ?>
        <?php echo $this->element('layout/mainmenu_admin') ?>
        <header class="header header-transparent header-waterfall">
            <ul class="nav nav-list pull-left visible-sm-or-smaller">
                <li>
                    <a data-toggle="menu" href="#menu">
                        <span class="icon icon-lg">menu</span>
                    </a>
                </li>
            </ul>
            <?php echo $this->Html->link(Cake\Core\Configure::read('cms.siteName'), '/', ['escape' => false, 'class' => 'header-logo']) ?>

            <ul class="nav nav-list hidden-sm-or-smaller pull-right">
                <?php echo $this->fetch('secondMenu'); ?> 
            </ul>
            <ul class="nav nav-list hidden-sm-or-smaller">
                <?php echo $this->fetch('mainMenu'); ?>
            </ul>

        </header>
        <nav aria-hidden="true" class="menu" id="menu" tabindex="-1">
            <div class="menu-scroll">
                <div class="menu-content">
                    <a class="menu-logo" href="#">ExperimentsLabs</a>
                    <ul class="nav">
                        <?php echo $this->fetch('mainMenu'); ?>
                    </ul>
                    <hr>
                    <ul class="nav">
                        <?php echo $this->fetch('secondMenu'); ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="content-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="heading"><span class="fa fa-wrench"></span>&nbsp;<?php echo $this->fetch('title') ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-inner">
                    <div class="row">
                        <!--<div class="col-sm-12">-->
                        <?php echo $this->Flash->render() ?>
                        <?php echo $this->fetch('content') ?>
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p>© 2015 Elabs</p>
            </div>
        </footer>
        <!-- Javascript at the end -->
        <?php echo $this->Html->script('lib/jquery-1.11.3.min.js') ?>
        <?php echo $this->Html->script('material.min.js') ?>
        <!-- Custom scripts -->
        <?php echo $this->fetch('pageBottomScripts') ?>
        <?php echo $this->Html->script('custom.js') ?>
    </body>
</html>
