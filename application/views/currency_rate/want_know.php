<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<div class="container wtent">

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well well-lg ">
                <span class="blue-font">Today Best Rate : </span>
                <?php if(!empty($best_rates)){ 
                    $x = count($best_rates);
                    $y = 1;
                ?>
                <span class="font14">
                <?php foreach($best_rates as $brow){?>
                    <?=$brow['currency']?> - <span class="no bold font17"><?=$brow['rate']?></span> <?=($x == $y ? '' : '/')?>
                <?php $y++; } } else { echo ' - '; } ?>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well well-lg">
                <h5 class="text-title-red">I WANT TO KNOW</h5><br/>
                <form class="form-horizontal" role="form" method="POST" action="<?=base_url()?>currency_rate/result_rate">
                    <div class="row">
                        <?php if(validation_errors()) { ?>
                        <div class="col-lg-12">
                            <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>
                                <strong><?= validation_errors();?></strong>
                            </div>
                        </div>
                        <?php } ?>
                    </div>                    
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Select Currency:</label>
                    <div class="col-sm-5">
                        <select class="form-control input-sm" name="currency_id" id="currency-select">
                            <option value="" selected>Select Currency</option>
                            <?php if($currencys != '') { ?>
                                <?php foreach($currencys as $cur) {  
                                    echo "<option value='". $cur['currency_id'] . "' >" . strtoupper($cur['currency']) . '(' . $cur['symbol'] . ')' . "</option>";
                                } ?>
                            <?php } ?>
                        </select> 
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Location:</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control input-sm" name="location" id="location" data-role="tagsinput" placeholder="Type Location and hit Enter" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-3">
                        <button type="submit" class="btn btn-custom pull-right">
                            Check Rate
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
    });
</script>