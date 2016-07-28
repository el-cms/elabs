<!DOCTYPE html>
<html lang="en">
    <head>
      <?php echo $this->Html->charset() ?>
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="initial-scale=1.0, width=device-width" name="viewport">
        <title>
          <?php echo $this->fetch('title') . ' &#8212; ' . Cake\Core\Configure::read('cms.siteName') ?>
        </title>
        <?php echo $this->Html->meta('icon') ?>

        <?php echo $this->Html->css('frontend.css', array('media' => 'screen')) ?>

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
      echo $this->element('layout/mainmenu_admin');
      ?>
        <!-- Navbar -->
        <nav class="navbar navbar-admin navbar-fixed-top">
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
                                      echo $this->element('users/usermenu');
                                  else:
                                      if (!is_null($authUser)):
                                          echo $this->element('users/usermenu');
                                      else:
                                          ?>
                                            <li><a href="#" data-toggle="modal" data-target="#loginModal"><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('sign-in'), __d('elabs', 'Login/Register')]) ?></a></li>
                                        <?php
                                        endif;
                                    endif;
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- / Right menu -->
                </div>
                <!-- / Links -->
            </div>
        </nav>
        <!-- / Navbar-->

        <!-- Page header -->
        <div class="page-header page-header-admin">
            <div class="container-fluid">
                <!-- Flash messages -->
                <div class="row flash-messages">
                  <?php echo $this->Flash->render() ?>
                </div>
                <!-- / Flash messages -->

                <!-- Title -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1><?php echo __d('elabs', '{0}&nbsp;{1}', [$this->Html->icon('wrench'), $this->fetch('title')]) ?></h1>
                    </div>
                </div>
                <!-- / Title -->
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
        <!-- / Header -->

        <!-- Main content (wrapped here for container-fluid) -->
        <div class="page-content">
            <div class="container-fluid">
                <!-- Content -->
                <?php echo $this->fetch('content') ?>
                <!-- / Content -->
            </div>
        </div>
        <!-- / Main content -->

        <!-- Footer -->
        <footer class="footer footer-admin">
            <div class="container-fluid">
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
