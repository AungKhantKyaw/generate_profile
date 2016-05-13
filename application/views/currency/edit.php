<?php 
     $action_url =  ($action == 'new') ? base_url()."currency/create" : base_url()."currency/edit/".$currency['currency_id'];
?>
<!--main content start-->
<div class="container wtent">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?=$action=='new'?'Add':'Edit'?> Currency
                    <div class="pull-right">
                        <div class="btn-group upp">
                            <a class="btn btn-primary btn-md" href="<?=base_url()?>currency"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
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
                        <form role="form" enctype="multipart/form-data" class="form-horizontal" id="add-item-form" method="post" action="<?php echo $action_url ?>"> 
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Country<span class="req"> * </span></label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="country" id="country" placeholder="Country" value="<?php echo (isset($_POST['country'])) ? $_POST['country'] : ( (isset($currency['country'])) ? $currency['country'] : ''); ?>">
                              </div>
                          </div>                            
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Currency<span class="req"> * </span></label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="currency" id="currency" placeholder="Currency" value="<?php echo (isset($_POST['currency'])) ? $_POST['currency'] : ( (isset($currency['currency'])) ? $currency['currency'] : ''); ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Symbol</label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="symbol" id="symbol" placeholder="Symbol" value="<?php echo (isset($_POST['symbol'])) ? $_POST['symbol'] : ( (isset($currency['symbol'])) ? $currency['symbol'] : ''); ?>">
                              </div>
                          </div>       
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Image Upload</label>
                              <div class="col-sm-5">
                                  <input type="file" name="logo" />
                                  <input type="hidden" name="himg" id="himg" value="<?php echo isset($_POST['himg']) ? $_POST['himg'] : ( isset($currency['img_file']) ? $currency['img_file'] : '') ; ?>" />                                
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-3 control-label lbl">Display Decimal</label>
                              <div class="col-sm-5">
                                <input type="text" class="form-control" name="decimal_no" id="decimal_no" placeholder="Display Decimal" value="<?php echo (isset($_POST['decimal_no'])) ? $_POST['decimal_no'] : ( (isset($currency['decimal_no'])) ? $currency['decimal_no'] : ''); ?>">
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