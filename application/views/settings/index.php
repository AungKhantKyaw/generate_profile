
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Settings</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="breadcrumb">
          <?php echo  $this->breadcrumb->output(); ?>        
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if(isset($msg) && $msg != '') { ?>
        <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><?php echo $msg; ?></div>
        <?php } ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php if(validation_errors()) { ?>
        <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
            <strong><?= validation_errors();?></strong>
        </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Change Password
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    <form role=form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Old Password</label>
                                </div>
                                <div class="col-lg-4 required-field-block">
                                    <input class="form-control input-sm" type="password" name="old_password" value="<?=isset($_POST['old_password']) ? $_POST['old_password'] : '';?>">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>New Password</label>
                                </div>
                                <div class="col-lg-4 required-field-block">
                                    <input class="form-control input-sm"  type="password" name="new_password" value="<?=isset($_POST['new_password']) ? $_POST['new_password'] :'';?>">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label>Confirm Password</label>
                                </div>
                                <div class="col-lg-4 required-field-block">
                                    <input class="form-control input-sm"  type="password" name="confirm_password" value="<?=isset($_POST['confirm_password']) ? $_POST['confirm_password'] :'';?>">
                                    <div class="required-icon">
                                        <div class="text">*</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-4">
                                <button type="submit" class="btn btn-primary btn-sm" value="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>