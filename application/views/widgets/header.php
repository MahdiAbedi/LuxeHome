<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo substr($page_title, 0, 65); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="<?php echo substr($meta_description, 0, 160); ?>">
        <meta name="keywords" content="<?php echo substr($key_words, 0, 255); ?>">
        <meta name="author" content="مشاوران املاک خانه رویایی">
        <base href="<?php echo base_url();?>">
        
        <link rel="icon" href="assets/img/favico.gif" type="image/x-icon" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <!-- Start BOOTSTRAP -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <!-- End Bootstrap -->
        <!-- Start Template files -->
        <link rel="stylesheet" href="assets/css/winter-flat.css" />
        <link rel="stylesheet" href="assets/css/custom.css" />
        <!-- End  Template files -->
      
        <!-- Start custom template style  -->
        <link rel="stylesheet" href="assets/css/custom_template_style.css" /> 
        <!-- End custom template style   -->
        <link rel="stylesheet" href="assets/css/styles_rtl.css" />
        
        
    </head>
    <body class="">
        <div id="fb-root"></div>
        <div class="container container-wrapper">
            <header class="header">
                <div class="top-box" data-toggle="sticky-onscroll">
                    <div class="container">
                        <div  class="top-bar color-primary">
                            <div class="container clearfix">
                                <div class="pull-left">
                                    <ul class="login-menu clearfix">
                                        
                                       
                                        <?php if($_SESSION['logged_in']):?>
                                        <li><a href="#"><i class="fa fa-list"></i> املاک من</a></li>
                                        <li><a href="#"><i class="fa fa-star"></i> املاک محبوب من</a></li>
                                        <li><a href="#"><i class="fa fa-envelope"></i> پیام های من </a></li>
                                        <li><a href="#"><i class="fa fa-user"></i> پروفایل من</a></li>
                                        <li><?php echo $_SESSION['name'];?> عزیز به خانه رویایی خوش آمدید  <a href="<?php echo base_url();?>login"><i class="fa fa-power-off"></i>خروج</a></li>
                                        <?php else:?>
                                        <li><a href="<?php echo base_url();?>login"><i class="fa fa-power-off"></i>ثبت نام/ورود</a></li>
                                        <?php endif;?>
                                    </ul>
                                </div>
                                <div class="pull-right">
                                    <ul class="social-nav clearfix">
                                        <li><a>Facebook</a></li>
                                        <li><a>Twitter</a></li>
                                        <li><a>Linkid</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- /.top-bar-->
                        <section class="header-inner">
                            <div class="container">
                                <div class="logo pull-left pull-sm-up col-sm-6 col-xs-12  text-left">
                                    <a href="<?php echo base_url();?>">
                                        <img data-src="assets/img/logo.png" alt="" />
                                        <img data-src="assets/img/logo_mini.png" alt="" class="mini-logo" />
                                    </a>
                                </div>
                                <div class="pull-right pull-sm-up col-sm-6 col-xs-12 websitetitle focus-color  ">
                                    <a href="<?php base_url();?>newhome" class="row">
                                        <div class="sub-title">به ما بپیوندید</div>
                                        <h2 class="title btn btn-success">ثبت رایگان ملک</h2>
                                    </a>
                                </div>
                                <div class="pull-left menu"> 
                                    <div class="box-navigaion clearfix">
                                        <div class="navbar-header">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                                                <span class="sr-only">جمع کردن منو</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div class="lang-manu dropdown pull-right">
                                            <button class="btn btn-secondary" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <img data-src="assets/img/flags/fa.gif" alt="" /> <span>ایران</span>
                                                <i class='icon-dropdown'></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="about-us">
                                                <a class="dropdown-item" href="#">
                                                    <img data-src="assets/img/flags/fa.gif" alt="" /> ایران
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <nav class="navbar text-color-primary">
                                        <div class="text-right">
                                            <button class="navbar-toggler hidden" type="button" data-toggle="collapse" data-target="#main-menu">
                                                &#9776;
                                            </button>
                                        </div>
                                        <!-- Links -->
                                        <div class="collapse navbar-collapse" id="main-menu">
                                            <ul class="nav navbar-nav clearfix">
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle"  href="<?php echo base_url(); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                                                        خانه رویایی
                                                       
                                                    </a>
                                                    
                                                </li>
                                                
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="<?php echo base_url()."agents" ?>">
                                                        مشاوران املاک
                                                       
                                                    </a>
                                                    
                                                </li>
                                             
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="<?php echo base_url()."blog" ?>">
                                                        بلاگ
                                                        
                                                    </a>
                                                    
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="<?php echo base_url()."contact" ?>">
                                                        تماس با ما
                                                        
                                                    </a>
                                                    
                                                </li>
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </section><!-- /.menu-->
                    </div> 
                </div>
                <div class="top-box-mask"></div>
                