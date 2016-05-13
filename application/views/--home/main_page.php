<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>


<div class="container wtent">
    <br/>
<?php if(isset($msg) && $msg != '') { ?>
        <div class="row">
            <div class="col-lg-10">
                <div class="alert alert-success" id="msg"><a class="close" data-dismiss="alert">×</a><?php echo $msg; ?></div>
            </div>
        </div>
<?php } ?>

<div class="row">
<div class="col-lg-12">

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="tabs">
    <li class="active"><a href="#share" role="tab" data-toggle="tab">
        I Want to Share <icon class="fa fa-share-alt"></icon></a>
    </li>
    <li><a href="#know" role="tab" data-toggle="tab">
        I Want to Know <i class="fa fa-question"></i></a>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade active in" id="share">
        <form role="form" method="get" id="flagform" action="<?=base_url()?>currency_rate/want_to_share">
                <div class="row">
                    <div class="col-md-12">
                        <div id="currency-check"></div>
                        <br/>
                        <h5 class="blue-font bold">Please choose your currency</h5><br/><br/>
                            <div class="row flagrow">
                            <?php
                                if(!empty($currens)){
                                    $x = 1;
                                    foreach($currens as $key=>$val){                                
                            ?>
                                <div class="col-md-2 radiogp">                            
                                    <input type="radio" class="radio_item" value="<?=$val['currency_id']?>" name="itm" id="<?=$key?>">
                                    <label class="label_item" for="<?=$key?>" data-placement="top" title="<?=$val['symbol']?>"><img src="<?=base_url()?>uploads/<?=$val['img_file']?>" class="img-reponsive customimg" alt="<?=$val['country']?>"></label>
                                    <p class="blue-font upptxt" style="font-size:13px;"><?=$val['currency']?></p>
                                </div>   

                            <?php } $x++; } ?>                                                                                                                                                        
                            </div>
                            <br/><br/>
                            <div id="currency-error"></div>

                <span class="pull-left">
                <span class="blue-font pull-left">Latest Best Rate :</span>&nbsp;
                <?php if(!empty($trates)){ 
                    $x = count($trates);
                    $y = 1;
                ?>
                <span class="font14">
                <?php foreach($trates as $brow){?>
                    <?=$brow['symbol']?> - <span class="no bold font17"><?=($brow['decimal_no'] != 0 ? number_format($brow['rate'],$brow['decimal_no']) : number_format($brow['rate']))?></span>&nbsp;<span style="font-size:12px;"><?=date('d-M',$brow['post_date'])?></span> <?=($x == $y ? '' : '/')?>
                <?php $y++; } } else { echo ' - '; } ?>
                </span>
                </span>


                        </div>
                    </div>

                <?php
                    $date = date('d-m-Y');
                    $end  = date('d-m-Y',(strtotime ( '-3 day' , strtotime ( $date) ) ));
                ?>                
         </form>
    </div>
    <div class="tab-pane fade" id="know">
        <form role="form" method="get" id="flagpostform" action="<?=base_url()?>currency_rate/result_rate">
                <div class="row">
                    <div class="col-lg-12">
                        <div id="currency-check"></div>
                        <br/>
                        <h5 class="blue-font bold">Please choose your currency</h5><br/><br/>
                            <div class="row flagrow">
                            <?php
                                if(!empty($currens)){
                                    $x = 1;
                                    foreach($currens as $key=>$val){                                
                            ?>
                                <div class="col-md-2 radiogp2">                            
                                    <input type="radio" class="rdo_2" value="<?=$val['currency_id']?>" name="flag_item_2" id="a-<?=$key?>">
                                    <label class="label_item_2" for="a-<?=$key?>" data-placement="top" title="<?=$val['symbol']?>"><img src="<?=base_url()?>uploads/<?=$val['img_file']?>" class="img-reponsive customimg" alt="<?=$val['country']?>"></label>
                                    <p class="blue-font upptxt" style="font-size:13px;"><?=$val['currency']?></p>
                                </div>   

                            <?php } $x++; } ?>                                                                                                                                                        
                            </div>
                            <br/><br/>
                            <div id="currency-error"></div>

                <span class="pull-left">
                <span class="blue-font pull-left">Latest Best Rate :</span>&nbsp;
                <?php if(!empty($trates)){ 
                    $x = count($trates);
                    $y = 1;
                ?>
                <span class="font14">
                <?php foreach($trates as $brow){?>
                    <?=$brow['symbol']?> - <span class="no bold font17"><?=($brow['decimal_no'] != 0 ? number_format($brow['rate'],$brow['decimal_no']) : number_format($brow['rate']))?></span>&nbsp;<span style="font-size:12px;"><?=date('d-M',$brow['post_date'])?></span> <?=($x == $y ? '' : '/')?>
                <?php $y++; } } else { echo ' - '; } ?>
                </span>
                </span>


                        </div>
                    </div>

                <?php
                   // $date = date('d-m-Y');
                    //$end  = date('d-m-Y',(strtotime ( '-3 day' , strtotime ( $date) ) ));
                ?>
                <input type="hidden" id="hidsflag" name="currency_id" />
               <!--  <input type="hidden" name="start_date" value="<?=$end?>" />
                <input type="hidden" name="end_date" value="<?=$date?>" /> -->
                <!-- <input type="hidden" id="type" name="htype" value="home" /> -->

         </form>
    </div><!-- end know -->
</div>

           


</div><!-- col-lg-12 -->

</div><!-- row -->
</div><!-- container -->
<br/><br/><br/><br/>

<div class="blockarea">&nbsp;</div>
<br/><br/>
<script type="text/javascript">
var base_url = '<?=base_url()?>';
$(function(){


    // $("[data-toggle='tooltip']").tooltip();
    $(".label_item").tooltip();
    $(".label_item_2").tooltip();

    $('#datetimepicker5').datetimepicker({
        format      :'D-M-YYYY h:mm A',
        maxDate     : new Date(),
        defaultDate : new Date(),
    });

    $("#currency-select").select2();

    // $('#address').autocomplete({
    //     source: function (request, response) {
    //         $.ajax({
    //             type: 'POST',
    //             url: "<?=base_url();?>"+'user_address/request_address',
    //             data: request,
    //             success: function(data){
    //                      response(data);
    //             },
    //             dataType: 'json'
    //         });
    //     },
    //     error: function(data) {
    //         console.log('wrong'); 
    //     },           
    // });

    var type = window.location.hash.substr(1);
    if(type != ''){
        $('.nav-tabs a[href="'+ type +'"]').tab('show')
    }

    $('#share .radio_item').on('click', function(){
        var tval = $(this).val();
        $('#hidflag').val(tval);
        $('#flagform').submit();
    }); 

    $('#know .rdo_2').on('click', function(){
        var tval = $(this).val();        
        $('#hidsflag').val(tval);
        $('#flagpostform').submit();       
    }); 

    // if ($('#msg').is(':visible') && $('#msg').html().trim()) {
    //     alert('Successfully Signup.Activation link send to email');
    //     window.location.href = base_url;   
    // }

    // for bootstrap 3 use 'shown.bs.tab', for bootstrap 2 use 'shown' in the next line
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // save the latest tab; use cookies if you like 'em better:
        localStorage.setItem('lastTab', $(this).attr('href'));
    });

    // go to the latest tab, if it exists:
    var lastTab = localStorage.getItem('lastTab');
    if (lastTab) {
        $('[href="' + lastTab + '"]').tab('show');
    }

});
</script>