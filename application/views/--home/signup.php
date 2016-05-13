<div class="container wb">
    <div class="row centered">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-lg-offset-1">
                    <h3 class="text-title detail-title align-left" style="margin-top:30px;">Create your account</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                <div class="well">
                    <form method="post" action="<?=base_url()?>home/signup">     
                    <?php if(validation_errors()) { ?>
                        <div class="col-lg-10">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= validation_errors();?></strong>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if(isset($msg) && $msg != '') { ?>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="alert alert-success" id="msg"><?php echo $msg; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6"> 
                            <br/>
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                                        <input class="form-control" placeholder="Email" id="email" name="email" type="email" value="<?=$this->input->post('email')?>">
                                    </div>
                                </div>
                               
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                        <input class="form-control" placeholder="Password" id="register-password" name="password" type="password">
                                    </div>
                                </div>
                               
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                                        <input class="form-control" placeholder="Re-Type Password" id="register-confirm-password" name="confirm_password" type="password">
                                    </div>   
                                </div>
                                <div class="col-lg-11">
                                    <button type="submit" class="btn btn-custom btn-block" id="btn-create-acc">Create Account</button>                       
                                                                    <br/>
                                </div>

                                <span class="forgot-text">Already have an account. Please login (or) 
                                <u><a class="" href="#" data-toggle="modal" data-target="#ForgotModal" href="#ForgotModal">Forgot Your Password?</a></u></span>
                            </div>  
                        </div><!-- end side 1 -->
                        <div class="col-lg-6">
                            

                        </div>
                    </form>
                </div>
                </div>
            </div>         
        </div><!-- col-lg-12 -->
    </div><!-- row -->
</div><!-- container -->
<div class="blockarea">&nbsp;</div>
<br/><br/>
<script type="text/javascript">
var base_url = '<?=base_url()?>';
$(function(){

    $('#btn-create-acc').on('click', function(){

        var register_password = $('#register-password').val();
        var confirm_password = $('#register-confirm-password').val();

        if (register_password != confirm_password) {
            alert('Password and re-type password do not match.');
            return false;
        }

    });

    if ($('#msg').is(':visible') && $('#msg').html().trim()) {
        alert('Successfully Signup.The activation link has been sent to your email address');
        window.location.href = base_url;   
    }

});
</script>