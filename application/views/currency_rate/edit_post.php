<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/jquery-ui.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<script src="<?= base_url();?>public/js/jquery-ui.js"></script>
<?php  $action_url =  ($action == 'edit') ? base_url()."currency_rate/post_edit/".$cur_post['post_id'] : base_url()."currency_rate/user_post_edit/".$cur_post['post_id']; ?>
<div class="container wtent">
    <br/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well well-lg">
                <h5 class="text-title-red">Edit Rate</h5><br/>
                <form class="form-horizontal" role="form" method="post" action="<?=$action_url?>">                    
                    <div class="row">
                        <?php if(validation_errors()) { ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
                                <strong><?= validation_errors();?></strong>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($msg) && $msg != '') { ?>
                            <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><?php echo $msg; ?></div>
                            <?php } ?>
                        </div>
                    </div>                                      
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="currency">Currency<span class="req"> * </span></label>
                    <div class="col-sm-6">
                    <select class="form-control input-sm tbox" name="currency_id" id="currency-select">
                      <option value="" selected>Select Currency</option>
                        <?php if($currencys != '') { ?>
                        <?php foreach($currencys as $srow) {  
                        if( isset($_POST['currency_id']) && ($_POST['currency_id'] == $srow['currency_id']) ) {
                          echo "<option selected value='". $srow['currency_id'] . "' >" . $srow['currency'] . '(' . $srow['symbol'] . ')' . "</option>";
                        }
                        else if( isset($cur_post['currency_id']) && ($cur_post['currency_id'] == $srow['currency_id']) ) {
                          echo "<option selected value='". $srow['currency_id'] . "' >" . $srow['currency'] . '(' . $srow['symbol'] . ')' . "</option>";
                        }
                        else {
                          echo "<option value='". $srow['currency_id'] . "' >" . $srow['currency'] . '(' . $srow['symbol'] . ')' . "</option>";
                        }
                        } ?>
                        <?php } ?>
                    </select>   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="rate">Rate<span class="req"> * </span></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="rate" id="rate" placeholder="Enter Your Rate!" value="<?php echo (isset($_POST['rate'])) ? $_POST['rate'] : ( (isset($cur_post['rate'])) ? $cur_post['rate'] : ''); ?>">
                    </div>
                  </div>                       
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Location<span class="req"> * </span></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control input-sm" name="location" id="location" data-role="tagsinput" placeholder="Type Location and hit Enter" value="<?php echo (isset($_POST['location'])) ? $_POST['location'] : ( (isset($cur_post['location'])) ? $cur_post['location'] : ''); ?>">
                    </div>
                  </div>                             
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Remark:</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" rows="5" name="remark" id="remark"><?php echo isset($_POST['remark']) ? $_POST['remark'] : ( isset($cur_post['remark']) ? $cur_post['remark'] : '') ; ?></textarea>
                    </div>
                  </div>      
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Address</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" rows="5" name="address" id="address"><?php echo isset($_POST['address']) ? $_POST['address'] : ( isset($cur_post['address']) ? $cur_post['address'] : '') ; ?></textarea>
                    </div>
                  </div>                               
                  <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-3">
                        <button type="submit" class="btn btn-custom pull-right" id="btn-submit">
                            Update Rate
                        </button>
                    </div>
                  </div>                  
                </form>
            </div>
        </div><!-- col-lg-10 -->
    </div><!-- row -->
</div><!-- container -->
<br/><br/><br/><br/>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker5').datetimepicker({
            format      :'D-M-YYYY h:mm A',
            maxDate     : new Date(),
            defaultDate : new Date(),
        });

        $("#currency-select").select2();

        $('#address').autocomplete({
            source: function (request, response) {
                $.ajax({
                    type: 'POST',
                    url: "<?=base_url();?>"+'user_address/request_address',
                    data: request,
                    success: function(data){
                         response(data);
                    },
                    dataType: 'json'
                });
            },
            error: function(data) {
               console.log('wrong'); 
            },           
        });
    

    });

    //  function getAddress(getVal){ 

    //         $('#address').autocomplete({
    //         source: function () {
    //         $.ajax({
    //               type: 'POST',
    //               url: "<?=base_url();?>"+'user_address/request_address',
    //               data: getVal,
    //               success: function(data){
    //                      response(data);
    //               },
    //               dataType: 'json'
    //             });
    //         },
    //         select: function (event, ui) {
    //             //getID(ui.item.value, inDiv);
    //         }
    //     });

    // }
</script>