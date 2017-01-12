<?php
// Define the lang attribute for titles
$contentLanguage = $this->fetch('contentLanguage');
?>
<!DOCTYPE html>
<html lang="<?php echo $siteLanguage ?>">
    <head>
        <?php echo $this->Html->charset() ?>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="initial-scale=1.0, width=device-width" name="viewport">
        <title<?php echo $this->Html->langAttr($contentLanguage) ?>>
            <?php echo strip_tags($this->fetch('title')) . ' &#8212; ' . Cake\Core\Configure::read('cms.siteName') ?>
        </title>
        <?php echo $this->Html->meta('icon') ?>

        <?php echo $this->Html->css('style.css', array('media' => 'screen')) ?>

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
        <?php
        echo $this->element('layout/pageloader');
        echo $this->element('layout/mainmenu');
        ?>
        <!-- Navbar -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Header and expand button -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <?php echo $this->Html->icon('bars') ?>
                    </button>
                    <?php echo $this->Html->link(__d('elabs', '{0} {1}', [$this->Html->image('logo-32.png'), Cake\Core\Configure::read('cms.siteName')]), '/', ['escape' => false, 'class' => 'navbar-brand']) ?>
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
                                            echo $this->Gravatar->generate($authUser['email'], ["size" => "20px"]);
                                        else:
                                            echo $this->Html->icon('user');
                                        endif;
                                        ?>
                                    </span>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if (!is_null($authUser)):
                                        echo $this->element('layout/mainmenu_usermenu');
                                    else:
                                        ?>
                                        <li><a href="#" data-toggle="modal" data-target="#loginModal"><?php echo $this->Html->iconT('user-plus', __d('elabs', 'Login')) ?></a></li>
                                        <li><?php echo $this->Html->link($this->Html->iconT('sign-in', __d('elabs', 'Register')), ['prefix' => null, 'plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'register'], ['escape' => false]) ?></li>
                                    <?php
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
        <div class="page-header">
            <div class="container-fluid">
                <div class="container">
                    <!-- Flash messages -->
                    <div class="row flash-messages">
                        <div class="alert alert-warning"<?php echo $this->Html->langAttr('en') ?>>
                            <strong>Note that this website is still under contruction (<a href="https://github.com/el-cms/elabs">sources are on <i class="fa fa-github"></i> Github</a>). Some features may not work or not be implemented. And there are bugs. Thank you.</strong>
                        </div>
                        <?php echo $this->Flash->render() ?>
                    </div>
                    <!-- / Flash messages -->

                    <!-- Title area-->
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Title -->
                            <h1<?php echo $this->Html->langAttr($contentLanguage) ?>><?php echo $this->fetch('title') ?></h1>
                            <!-- / Title -->

                            <!-- Breadcrumbs -->
                            <?php
                            // Root
                            echo $this->Html->getCrumbList([], ['text' => $this->Html->icon('home'), 'url' => null, 'escape' => false])
                            ?>
                            <!-- / Breadcrumbs -->
                        </div>
                    </div>
                    <!-- / Title area -->
                </div>
            </div>
            <!-- Toolbar -->
            <?php
            $pageToolbar = $this->fetch('pageToolbar');
            if (!empty($pageToolbar)):
                ?>
                <div class="toolbar">
                    <div class="container">
                        <?php echo $this->fetch('pageToolbar') ?>
                    </div>
                </div>
                <?php
            endif;
            ?>
            <!-- / Toolbar -->
        </div>
        <div class="container page-content">
            <!-- Content -->
            <?php echo $this->fetch('content') ?>
            <!-- / Content -->
        </div>
        <!-- / Main content -->

        <!-- Login modal -->
        <?php
        if (is_null($authUser)):
            echo $this->element('users/loginmodal');
        endif;
        ?>
        <!-- /Login modal -->

        <!-- Report modal -->
        <?php echo $this->element('reports/add_modal'); ?>
        <!-- / Report modal -->

        <!-- Footer -->
        <footer class="footer footer-default">
            <div class="container">
                <?php echo $this->element('layout/footer'); ?>
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
