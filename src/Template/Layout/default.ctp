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

        <?php echo $this->Html->css('frontend.css', array('media' => 'screen,projection')) ?>

        <?php echo $this->fetch('meta') ?>
        <?php echo $this->fetch('css') ?>
        <?php echo $this->fetch('script') ?>

        <!-- ie -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php echo $this->element('layout/pageloader') ?>
        <?php echo $this->element('layout/mainmenu') ?>
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Header and expand button -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php echo $this->Html->link(Cake\Core\Configure::read('cms.siteName'), '/', ['class' => 'navbar-brand']); ?>
                </div>
                <!-- / Header and expand button -->

                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbar">
                    <!-- Main menu -->
                    <div>
                        <ul class="nav navbar-nav">
                            <?php echo $this->fetch('mainMenu'); ?>
                        </ul>
                    </div>
                    <!-- / Main menu -->

                    <!-- Right menu -->
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="avatar">
                                        <?php
                                        if (!is_null($authUser)):
                                            echo $this->Gravatar->generate($authUser['email'], ["size"=>"20px"]);
                                        else:
                                            ?><span class="fa fa-user"></span><?php
                                        endif;
                                        ?>
                                    </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if (!is_null($authUser)):
                                        echo $this->element('users/usermenu');
                                    else:
                                        if (!is_null($authUser)):
                                            echo $this->element('users/usermenu');
                                        else:
                                            ?>
                                            <li><a href="#" data-toggle="modal" data-target="#loginModal"><?= __('{0}&nbsp;{1}', [$this->Html->icon('sign-in'), __('Login/Register')]) ?></a></li>
                                        <?php
                                        endif;
                                    endif;
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php echo $this->fetch('secondMenu'); ?> 
                        </ul>
                    </div>
                    <!-- / Right menu -->
                </div>
                <!-- / Links -->
            </div>
        </nav>
        <!-- / Navbar-->

        <!-- Main content -->
        <div class="content">
            <div class="content-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="heading"><?php echo $this->fetch('title') ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-inner">
                    <div class="row">
                        <?php echo $this->Flash->render() ?>
                        <?php echo $this->fetch('content') ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Main content -->
        
        <!-- Login modal -->
        <?php
        if (is_null($authUser)):
            echo $this->element('users/loginmodal');
        endif;
        ?>
        <!-- /Login modal -->
        
        <!-- Footer -->
        <footer class="navbar navbar-default navbar-static">
            <div class="container">
                <p class="navbar-text">&copy; 2015 Elabs</p>
            </div>
        </footer>
        <!-- Javascript at the end -->
        <?php echo $this->Html->script('lib/jquery.min.js') ?>
        <?php echo $this->Html->script('bootstrap.min.js') ?>
        <?php echo $this->Html->script('bootstrap-tagsinput.min.js') ?>
        <!-- Custom scripts -->
        <?php echo $this->fetch('pageBottomScripts') ?>
        <?php echo $this->Html->script('custom.js') ?>
    </body>
</html>
