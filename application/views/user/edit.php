<?php 
    $action_url =  ($action == 'new') ? base_url()."user/create" : base_url()."user/edit/".$user['user_id'];
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

        $('#is_activate').change(function() {
          if(this.checked) {
            $('#is_activate').val(1);
          }
          else{
            $('#is_activate').val(0);
          }
        });

        $('#btn-submit').click(function(e){
            e.preventDefault();
            if($('#password').val() != $('#repassword').val()) {
                $('#password, #repassword').closest('.form-group').addClass('has-error');
            }
            else {
                $('#add-user-form').submit();    
            }

        }); 

    });
</script>
<!--main content start-->
<div class="container wtent">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?=$action=='new'?'Add':'Edit'?> User
                    <div class="pull-right">
                        <div class="btn-group upp">
                            <a class="btn btn-primary btn-md" href="<?=base_url()?>user/index"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
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
                        <form role="form" class="form-horizontal" id="add-user-form" method="post" action="<?php echo $action_url ?>"> 
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Email<span class="req"> * </span></label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo (isset($_POST['email'])) ? $_POST['email'] : ( (isset($user['email'])) ? $user['email'] : ''); ?>">
                              </div>
                          </div>                            
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Password</label>
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
                              <label for="name" class="col-sm-3 control-label lbl">Activate</label>
                              <div class="col-sm-5">
                                <?php $checked = (isset($user['is_activate']) && $user['is_activate'] == 1) ? 'checked' : ( (isset($_POST['is_activate']) && $_POST['is_activate'] == 1) ? 'checked' : '' ); ?>
                                <input type="checkbox" name="is_activate" id="is_activate" style="margin-top:10px;" <?php echo $checked; ?> value="<?php echo (isset($_POST['is_activate'])) ? $_POST['is_activate'] : ( (isset($user['is_activate'])) ? $user['is_activate'] : ''); ?>" />                              
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