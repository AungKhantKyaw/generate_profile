<?php 
    $action_url =  base_url()."user/profile/".$user['user_id'];
?>
<script>
    $( document ).ready(function() {
        $('#repassword').focusout(function(){
            if($('#password').val() != $('#repassword').val()) {
               $('#password, #repassword').closest('.form-group').addClass('has-error');
            }   
            else {
                $('#password, #repassword').closest('.form-group').removeClass('has-error');
            }
        }); 

        $('#password').focusout(function(){
            if( $('#repassword').val() != '' ) {
                if($('#password').val() != $('#repassword').val()) {
                   $('#password, #repassword').closest('.form-group').addClass('has-error');
                }   
                else {
                    $('#password, #repassword').closest('.form-group').removeClass('has-error');
                }
            }
        }); 

        $('#btn-submit').click(function(e){
            e.preventDefault();
            if($('#password').val() != $('#repassword').val()) {
                $('#password, #repassword').closest('.form-group').addClass('has-error');
            }
            else {
                $('#profile-form').submit();    
            }

        }); 

    });
</script>
<div class="container wtent">
    <br/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well well-lg">
                <h5 class="text-title-red">UPDATE PROFILE</h5><br/>
                <div class="row">
                    <?php if(validation_errors()) { ?>
                    <div class="col-lg-12">
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong><?= validation_errors();?></strong>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(isset($msg) && $msg != '') { ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <div class="alert alert-success" id="msg"><?php echo $msg; ?></div>
                            </div>
                        </div>
                    <?php } ?>                    
                </div>                
                <form class="form-horizontal" role="form" method="post" id="profile-form" action="<?=$action_url?>">                    
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="passwrod">New Password:</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="repassword">Retype Password:</label>
                    <div class="col-sm-5">
                      <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Retype Password">
                    </div>
                  </div><br/>                                                
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-3">
                        <button type="submit" id="btn-submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                  </div>                  
                </form>
            </div>
        </div><!-- col-lg-10 -->
    </div><!-- row -->
</div><!-- container -->
<br/><br/><br/><br/>