<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SG Currency Rate</title>
   
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url()?>public/css/bootstrap.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="<?=base_url()?>public/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Own Css -->
    <link href="<?=base_url()?>public/css/admin_style.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?=base_url()?>public/js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>public/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row content-area">
            <div class="col-md-4 login-center">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">                       
                            <h3 class="logo_text">SG Currency Rate</h3>               
                    </div>
                    <div class="panel-body">
                        <?php if (validation_errors()){ ?>
                            <div class="alert alert-danger">
                                <?=validation_errors();?>
                            </div>
                        <?php } else if(isset($invalid) && $invalid == 1) { ?>
                            <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><?php  echo "Invalid User Name or Password."; ?></div>
                        <?php } ?>  
                        <form role="form" method="post">
                            <fieldset>
                                <div class="form-group input-group <?=form_error('username')?'has-error':''?>">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="autofocus" autocomplete="off" value="<?=$this->input->post('username')?>">
                                </div>
                                <div class="form-group input-group <?=form_error('password')?'has-error':''?>">
                                    <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-sign-in"></i>&nbsp;Login
                                    </button>
                                </div>
                                 <a href="<?=base_url()?>">Back to Site</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer">
            <div class="footer-separator"></div>
            <div class="copyright-text text-right" >&copy; <?=date('Y')?> SG Currency Rate</div>
        </div>
    </div>

</body>

</html>
