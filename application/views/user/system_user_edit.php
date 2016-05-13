<?php 
    $action_url =  ($action == 'new') ? base_url()."user/system_user_create" : base_url()."user/system_user_edit/".$sys_user['admin_id'];
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
                $('#add-item-form').submit();    
            }

        }); 

    });
</script>
<!--main content start-->
<div class="container wtent">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?=$action=='new'?'Add':'Edit'?> System User
                    <div class="pull-right">
                        <div class="btn-group upp">
                            <a class="btn btn-primary btn-md" href="<?=base_url()?>user/system_user"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <?php if(validation_errors()) { ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
                                <strong><?= validation_errors();?></strong>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.row -->
                    <div class="col-md-12"><br/>
                        <form role="form" class="form-horizontal" id="add-item-form" method="post" action="<?php echo $action_url ?>"> 
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Name<span class="req"> * </span></label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Name" value="<?php echo (isset($_POST['admin_name'])) ? $_POST['admin_name'] : ( (isset($sys_user['admin_name'])) ? $sys_user['admin_name'] : ''); ?>">
                              </div>
                          </div>                            
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Password<span class="req"> * </span></label>
                              <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Retype Password</label>
                              <div class="col-sm-5">
                                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Retype Password">
                              </div>
                          </div>                          
                          <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                              <button type="submit" class="btn btn-primary btnalign" id="btn-submit"><?php echo ($action == 'new') ? "Save" : "Update" ?></button>
                            </div>
                          </div>                                                 
                        </form>
                    </div>

                </div><!-- end panel -->
            </div>
        </div>
    </div>
</div><!-- container -->
<!--main content end-->