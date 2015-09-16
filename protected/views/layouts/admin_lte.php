<?php
define('LTE', Yii::app()->baseUrl.'/AdminLTE/');
define('LTE_CSS', LTE.'css/');
define('LTE_JS', LTE.'js/');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= !empty($this->pageTitle) ? $this->pageTitle : '' ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?=LTE_CSS?>bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=LTE_CSS?>font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=LTE_CSS?>ionicons.min.css" rel="stylesheet" type="text/css" />

        
        <link href="<?=LTE_CSS?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?=LTE_CSS?>colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        
        
        <!--link href="<?=LTE_CSS?>chosen.css" rel="stylesheet" type="text/css" /-->
        
        <!-- Theme style -->
        <link href="<?=LTE_CSS?>AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-black">
        <?php Yii::app()->bootstrap->register();  ?>
        <style>
            .top-menu li a {
                margin: 1px;
                width: 120px;
            }
            .top-menu li a::before {
                margin-left: 0px;
                padding: 5px;
            }        
        </style>

        <header class="header">
            <a href="/admin" class="logo">
                Dark Fish
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-left">
                
                <?php
                $this->widget('zii.widgets.CMenu',array(
    			'items'=>array(
    				array('label'=>'Мои таски',
                        'url'=>array('/site/index')),
    				array('label'=>'Статистика',
                        'url'=>array('/site/contact'),
                        'visible'=>thisUser()->superuser),
                    array('label'=>'Пользователи',
                        'url'=>'/user/',
                        'visible'=>thisUser()->superuser),
    				array('url'=>Yii::app()->getModule('user')->loginUrl,
                        'label'=>Yii::app()->getModule('user')->t("Login"),
                        'visible'=>Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->registrationUrl,
                        'label'=>Yii::app()->getModule('user')->t("Register"),
                        'visible'=>Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->profileUrl,
                        'label'=>Yii::app()->getModule('user')->t("Profile"),
                        'visible'=>!Yii::app()->user->isGuest),
                    array('url'=>Yii::app()->getModule('user')->logoutUrl,
                        'label'=>Yii::app()->getModule('user')->t("Logout").' ('.Yii::app()->user->name.')',
                        'visible'=>!Yii::app()->user->isGuest),
			     ),
                 'htmlOptions' => array('class' => 'nav navbar-nav')
		)); ?>
                </div>
                <div id="update_right" class="navbar-right" style="width: 35%;">
                    <?php $this->renderPartial('//site/rightStatus') ?>
                </div>
       
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">                
                <section class="sidebar">
                    <div class="user-panel">
                    <?php if (Yii::app()->user->isGuest) : ?>
                        <!-- GUEST -->
                    <?php else : ?>                    
                        <div class="pull-left image">
                            <?php if (!empty(Yii::app()->user->avatar)) : ?>
                            <img src="../../img/avatar3.png" class="img-circle" alt="User Image"/>
                            <?php else : ?>
                            <a><i class="fa fa-user"></i></a>
                            <?php endif ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo Yii::app()->user->name  ?></p>
                        </div> 
                    <?php endif ?>
                    </div>
                    
                    <?php $this->widget('application.widgets.MainMenuWidget', array('menu'=>array(
                        array(
                            'name'=>'Users',
                            'link'=>'/user/',
                            'icon'=>'fa-male'),
                        array(
                            'name'=>'Projects',
                            'link'=>'/site/index',
                            'icon'=>'fa-male'),
                        array(
                            'name'=>'In proccess',
                            'link'=>'/admin/user',
                            'icon'=>'fa-male'),
     
                             )));?>
                             <hr />
                    <?php
                        if (!empty(Yii::app()->request->cookies['projects'])) {
                            //var_dump()
                            $projects = json_decode(Yii::app()->request->cookies['projects']);
                            echo 'Coockie';
                        } else {
                            $api = new AsanaApi;
                            foreach ($api->workspaces->data as $workspace) {
                                $projectsJson = $api->asana->getProjectsInWorkspace($workspace->id, $archived = false);
                                $api->checkError($projectsJson);
                                Yii::app()->request->cookies['projects'] = new CHttpCookie('projects', $projectsJson);
                                $projects = json_decode($projectsJson);
                                break;
                            }
                            echo 'Not Coocies';
                        }
                        //var_dump($projects);exit;
                        foreach ($projects->data as $project) {
                            echo '<a class="btn btn-primary btn-block btn-sm btn-flat" href="/site/project/id/'.$project->id.'">' . $project->name . '</a>';
                        }
                        ?>
                                        
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                                
                <section class="content-header">
                    <h1><?php  echo  $this->pageTitle; ?></h1>
                    <?php if ( isset( $this->breadcrumbs ) ): ?>
                    <?php
                    $this->widget( 'zii.widgets.CBreadcrumbs', array(
                            'htmlOptions' => array( 'class' => 'breadcrumb' ),
                            'separator' => '',
                            'tagName' => 'ul',
                            'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                            'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                            'homeLink' => '<li><a href="' . Yii::app()->createUrl( 'admin' ) . '"><i class="fa fa-dashboard"></i> Admin</a></li>',
                            'links' => $this->breadcrumbs
                    ) );
                    ?>
                    <?php endif ?>
                </section>
                
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools pull-right">                         
                        
                        </div>
                    </div>
                </div>
                
                <?php
                $flashMessages = Yii::app()->user->getFlashes();
                if ($flashMessages) :
                    foreach ($flashMessages as $key => $message) : ?>
                        <br/>
                        <div class="alert alert-dismissable alert-<?php echo $key; ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong><?php echo $message; ?></strong>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>           
                <section class="content" style="padding-top:0px;">
                    <?php echo $content; ?>
                </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <!--script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!--script src="<?=LTE_JS?>bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=LTE_JS?>plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="/AdminLTE/js/jquery.nestable.js"></script>
        <script src="<?=LTE_JS?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="<?=LTE_JS?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?=LTE_JS?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->

        <script src="<?=LTE_JS?>plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script> 

        <!--script src="<?=LTE_JS?>chosen.jquery.js" type="text/javascript"></script-->
        
        <script src="<?=LTE_JS?>AdminLTE/app.js" type="text/javascript"></script>
        <?php // if (!thisUser()->superuser) : ?>
        <script>
        $(document).ready(function(){//return;
            //updateRight();
            setInterval(updateRight, 3000)
            function updateRight() {
                $.ajax({
                    url:'/site/updateRight',
                    success: function(data) {
                        $("#update_right").html(data);
                        //updateRight();
                    },
                    error: function(data) {
                        //updateRight();
                    },
                });
            }
        });
        </script>
        <?php //endif ?>
    </body>
</html>