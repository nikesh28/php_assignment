<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet" />

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.css" rel="stylesheet" />

        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" />

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container"> 
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span> 
                    </a>
                    <a class="brand" href="<?php echo Yii::app()->baseUrl; ?>">
                        Welcome to Tekdi
                    </a>
                        <?php
                        if (!Yii::app()->user->isGuest) {
                            ?>
                        <div class="nav-collapse">
                            <ul class="nav pull-right">
                                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                            class="icon-user"></i> <?php echo Yii::app()->user->name; ?> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
    <!--                                    <li><a href="<?php // echo $this->createUrl("user/profile");  ?>">Profile</a></li>-->
                                        <li><a href="<?php echo $this->createUrl("site/logout"); ?>">Logout</a></li>
                                    </ul>
                                </li>

                            </ul>                        
                        </div>        
                    <?php } ?>
                    <!--/.nav-collapse -->
                </div>
                <!-- /container -->
            </div>
            <!-- /navbar-inner -->
        </div>
        <?php
        if (!Yii::app()->user->isGuest) {
            $cont = Yii::app()->controller->id;
            ?>
            <div class="subnavbar">
                <div class="subnavbar-inner">
                    <div class="container">
                        <ul class="mainnav">
                            <li class="<?php if ($cont == "site") echo "active"; ?>"><a href="<?php echo $this->createUrl("site/dashboard"); ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>                        
    <!--                        <li class="<?php // if($cont == "user") echo "active";  ?>"><a href="<?php // echo $this->createUrl("user/profile");  ?>"><i class="icon-key"></i><span>Profile</span> </a></li>-->
                            <!--<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-list"></i><span>Manage First</span> <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/first/admin" rel="stylesheet" type="text/css" ><span>View First</span> </a> </li>
                                    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/index.php/first/create" rel="stylesheet" type="text/css" ><span>Create First</span> </a> </li>
                                </ul>
                            </li>-->
                        </ul>
                    </div>
                    <!-- /container -->
                </div>
                <!-- /subnavbar-inner -->
            </div>
        <?php } ?>


        <?php echo $content; ?>

        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

        <div class="footer">
            <div class="footer-inner">
                <div class="container">
                    <div class="row">
                        <div class="span12"> &copy; <?= date('Y'); ?><a href="<?php echo Yii::app()->request->baseUrl; ?>">[Tekdi]</a>. </div>
                        <!-- /span12 -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /footer-inner -->
        </div>

    </body>
</html>