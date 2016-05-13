<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GENERATE YOUR PROFILE PICTURE FOR FACEBOOK">
    <meta name="keywords" content="generate profile,profile picture,generate avatar blog">
    <meta name="author" content="">

    <meta property="og:title" content="Generate Profile | GENERATE YOUR PROFILE" />
    <meta property="og:site_name" content="Generate Profile" />
    <meta property="og:description" content="GENERATE YOUR PROFILE FOR FACEBOOK" />
    <meta property="og:image" content="http://generateyourprofile.com/public/img/genlogo.jpg">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://generateyourprofile.com/">

    <link rel="shortcut icon" href="<?=base_url()?>public/img/favicon.ico">

    <title>Generate Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>public/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>public/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <!-- Custom styles and plugins styles  -->
    <link href="<?=base_url()?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/custom.css" rel="stylesheet">
    <link href="<?= base_url();?>public/lib/alert/sweetalert.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- main js -->
    <script src="<?=base_url()?>public/js/jquery-1.11.0.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap.min.js"></script>  

  </head>

    <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php if (!$this->session->userdata('sgcurrency_validate_user')){ ?>   
          <a class="navbar-brand" href="<?=base_url()?>">
            <img src="<?=base_url()?>public/img/main_logo.png" class="img-responsive mlogo" title="generate profile picture"/>
          </a>
          <?php }else{ ?>
          <a class="navbar-brand" href="<?=base_url()?>gen_img/generate_profile">
            <img src="<?=base_url()?>public/img/main_logo.png" class="img-responsive mlogo" title="generate profile picture"/>
          </a>
          <?php } ?>
        </div>
        <div>
            <span class="title hidediv">
              <?php if (!$this->session->userdata('sgcurrency_validate_user')){ ?>   
              <a href="<?=base_url()?>">Generate Profile Picture : beta</a>
              <?php } else {  ?>
              <a href="<?=base_url()?>gen_img/generate_profile">Generate Profile Picture : beta</a>
              <?php } ?>
              
            </span>
        </div>
        <div class="navbar-collapse collapse">          
          <ul class="nav navbar-nav navbar-right">
<?php if (!$this->session->userdata('sgcurrency_validate_user')){   ?>            
<?php } else {  ?>
<?php
   $split = explode('@',$this->session->userdata('sgcurrency_email'));
   $uname = $split[0]; 
?>      
<?php
  if($this->session->userdata('sgcurrency_facebook') == 0){
?> 
            
            
<?php } ?> 
            <li><a href="<?=base_url()?>logout" class="logout">Logout</a></li> 
<?php } ?>            
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
            <li><a href="<?=base_url()?>home/faq" class="logout">FAQ</a></li>
          </ul>
          
          <span class="facebook_area">
            <?php if (!$this->session->userdata('sgcurrency_validate_user')){   ?>  
            <a class="btn btn-social btn-facebook btn-sm btn-flat" href="<?=base_url()?>facebooklogin">
                <i class="fa fa-facebook"></i> Login with Facebook
            </a> 
            <?php }else{ 
              if($this->session->userdata('sgcurrency_facebook') == 1){
                echo '<p>Welcome - <span class="wel-name">'. $uname . '</span>&nbsp;&nbsp;&nbsp;</p>';
              }
              else{
            ?>
            <p>Welcome - <span class="wel-name"><?=$uname;?> &nbsp;&nbsp;&nbsp;</span></p>
            <?php } }  ?>
          </span>    
          
        </div><!--/.nav-collapse -->
      </div>
    </div>

<div id="content-min">
  <div class="container">