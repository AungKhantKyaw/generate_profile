<!DOCTYPE html>
<html lang="en">
<head>
    <?php $b_url = base_url(); ?>
    <title>Chiang Kong</title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>css/bootstrap.css" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url(); ?>css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/custom.css" rel="stylesheet">
    <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>js/jquery-1.11.0.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom JavaScript for the Menu Toggle -->
        <script>
            $(function(){
                $("#admin-login-error").hide();

                $(".loginbtn").click(function(e){
                    e.preventDefault();
                    //var type = $('#rdotype').val();
                    if($('input[name=type]:checked').length<=0)
                    {
                        alert('Need to select Type');
                    }
                    else
                    {
                        $("#login-form").submit();
                    }
                });
            });
        </script>
</head>

<body>
<div class="container-fluid">
        <div class="row content-area">
            <div class="login-center span2 well">
                <legend style="color:#000;">Forgot Password</legend>
                <form role="form" id="login-form" method="post" action="<?= $b_url;?>login/forgot_password">
                  <fieldset>
                    <?php if(validation_errors()) { ?>
                      <div class="alert alert-danger"> <?php echo validation_errors(); ?> </div> 
                    <?php } else if(isset($invalid) && $invalid == 1) { ?>
                      <div class="alert alert-danger"> <?php  echo "Invalid Username"; ?> </div> 
                    <?php } ?>   
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" placeholder="User Name" id="username" name="username" autofocus />
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="inner-addon left-addon">
                                <label><input type="radio" name="type" id="rdotype" value="driver" <?php echo set_radio('type', 'driver'); ?> /> Driver</label>
                                <label><input type="radio" name="type" id="rdotype" value="serviceman" <?php echo set_radio('type', 'serviceman'); ?> /> Service Man</label> 
                                <label><input type="radio" name="type" id="rdotype" value="partner" <?php echo set_radio('type', 'partner'); ?> /> Partner</label> 
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="forgotpword">
                            <a href="<?php echo base_url(); ?>login"><< Back</a>
                        </div>
                    <div class="form-group btn-bottom-line"><button type="submit" class="btn btn-info loginbtn">Submit</button></div>
                  </fieldset>
                </form>  
            </div>
        </div>
   
</div>
</body>

</html>