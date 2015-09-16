<?php
define('LTE', Yii::app()->baseUrl.'/AdminLTE/');
define('LTE_CSS', LTE.'css/');
define('LTE_JS', LTE.'js/');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= Yii::app()->name ?> | <?= !empty($this->pageTitle) ? $this->pageTitle : '' ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?=LTE_CSS?>bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?=LTE_CSS?>font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?=LTE_CSS?>ionicons.min.css" rel="stylesheet" type="text/css" />

        
        <link href="<?=LTE_CSS?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?=LTE_CSS?>colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        
        
        <link href="<?=LTE_CSS?>chosen.css" rel="stylesheet" type="text/css" />
        
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
        
    <?php if (Yii::app()->user->isGuest) : ?>
        <!--        
        <div class="form-box" id="login-box">
            <div class="header">Форма авторизации</div>
            <form action="../../index.html" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Запомнить
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Войти</button> 
                    <br />
                    <p class="text-center"><a href="/"  class="btn bg-olive">Назад к сайту</a></p>       
                </div>
            </form>
        </div>   -->
        
    <?php else :  ?>
        
    <?php endif;  ?>

        <header class="header">
            <a href="/admin" class="logo">
                <?= Yii::app()->name ?>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a target="_blank" href="/" ><i class="glyphicon glyphicon-globe"></i><span>На сайт</span></a>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="/site/logout" ><i class="glyphicon glyphicon-home"></i><span>Выход</span></a>
                        </li>
                    </ul>
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
                            'name'=>'Пользователи',
                            'link'=>'/admin/user',
                            'icon'=>'fa-male'),
     
                             )));?>
                                        
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
                        <?php if (!empty($this->menu)) $this->widget('zii.widgets.CMenu', array(
                        'items'=>$this->menu,
                        'htmlOptions'=>array('class'=>'nav navbar-nav top-menu',),
                        )); ?>
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

        <script src="<?=LTE_JS?>chosen.jquery.js" type="text/javascript"></script>
        
        <script src="<?=LTE_JS?>AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>