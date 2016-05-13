<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/jquery-ui.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<script src="<?= base_url();?>public/js/jquery-ui.js"></script>
<div class="container wtent">
    <br/>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well well-lg">
                <h5 class="text-title-red">I WANT TO SHARE</h5><br/>
                <?php
                    if( isset($_GET['itm'])) {
                        $act_url = base_url().'currency_rate/share_rate?itm='.$_GET['itm'];
                    }
                    else{
                        $act_url = base_url().'currency_rate/share_rate/';
                    }
                ?>
                <form class="form-horizontal" role="form" method="post" action="<?=$act_url?>">                    
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
                        <select class="form-control input-sm" name="currency_id" id="currency-select">
                            <option value="" selected>Select Currency</option>
                            <?php if($currencys != '') { ?>
                                <?php foreach($currencys as $cur) { 
                                        if( isset($_GET['itm']) && ($_GET['itm'] == $cur['currency_id']) ) {
                                            echo "<option selected value='". $cur['currency_id'] . "' >" . strtoupper($cur['currency']) . '(' . $cur['symbol'] . ')' . "</option>";
                                        } 
                                        else{
                                            echo "<option value='". $cur['currency_id'] . "' >" . strtoupper($cur['currency']) . '(' . $cur['symbol'] . ')' . "</option>";
                                        }                                                                   
                                } ?>
                            <?php } ?>
                        </select>   
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="rate">Rate<span class="req"> * </span></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control holo" name="rate" id="rate" placeholder="Enter Your Rate!">
                    </div>
                  </div>                       
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Location<span class="req"> * </span></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="location" id="location" data-role="tagsinput" placeholder="Type Location and hit Enter" value="">
                    </div>
                  </div>                 
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="datepicker">Date / Time<span class="req"> * </span></label>
                    <div class="col-sm-6">         
                        <input type='text' class="form-control holo" id='datetimepicker5' name="datetime" />
                    </div>
                  </div>            
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Remark:</label>
                    <div class="col-sm-6">
                     <textarea class="form-control holo" rows="5" name="remark" id="remark"></textarea>
                    </div>
                  </div>  
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Address </label>
                    <div class="col-sm-6">
                     <textarea class="form-control" rows="5" name="address" id="address"></textarea>
                    </div>
                  </div>                                    
                  <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-3">
                        <?php
                            $date = date('d-m-Y');
                            $end  = date('d-m-Y',(strtotime ( '-3 day' , strtotime ( $date) ) ));
                        ?>
                        <input type="hidden" name="start_date" value="<?=$end?>" />
                        <input type="hidden" name="end_date" value="<?=$date?>" />                            
                        <button type="submit" class="btn btn-custom pull-right" id="btn-submit">
                            Share Rate
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