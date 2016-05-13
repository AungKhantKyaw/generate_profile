<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?=base_url()?>public/img/favicon.ico">

    <title>SG CURRENCY RATE</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>public/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>public/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">


    <!-- Custom styles and plugins styles  -->
    <link href="<?=base_url()?>public/css/main.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/custom.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/admin_custom.css" rel="stylesheet">
    <link href="<?=base_url()?>public/css/bootstrap-formhelpers.css" rel="stylesheet">
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
          <a class="navbar-brand" href="<?=base_url()?>dashboard">
            <img src="<?=base_url()?>public/img/main_logo.png" class="img-responsive mlogo" />
          </a>
        </div>
        <div>
            <span class="title hidediv"> <a href="<?=base_url()?>dashboard">Admin Panel </a></span>
        </div>
        <div class="navbar-collapse collapse">          
          <ul class="nav navbar-nav navbar-right">
            <li class=""><a href="<?=base_url()?>currency_rate/all_post">Post</a></li>
            <li class=""><a href="<?=base_url()?>currency/index">Currency</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li class=""><a href="<?=base_url()?>user/index">Public User</a></li> 
                  <li class=""><a href="<?=base_url()?>user/system_user">System User</a></li>
                </ul>
            </li>                          
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome :: <?= strtoupper($this->session->userdata('admin_name')); ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?=base_url()?>user/system_user_edit/<?=$this->session->userdata('user_id')?>">Update Profile</a></li>
                  <li role="separator" class="divider"></li>
                  <li class=""><a href="<?=base_url()?>adminlogin/logout">Logout</a></li>
                </ul>
            </li>                       
          </ul>    
        </div><!--/.nav-collapse -->
      </div>
    </div>

<div id="content-min">