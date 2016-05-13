    <div class="container wb">
        <div class="row centered">
            <div class="col-lg-10 col-lg-offset-1">
                <h1 class="upptxt big-font">
                    Generate <span class="pred-font">Facebook Profile</span> picture 
                </h1>

            </div><!-- col-lg-10 -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container mixalign">
        <div class="row centered">
            <div class="col-lg-12">                  
                <h2 class="anfont leftalign">Generate profile picture in <span class="pred-font upptxt bold">2</span> easy steps !</h2><br/>
                    <div class="col-md-3">
                        <div class="well well-blue">
                            <div class="fixalign">
                            <a class="btn btn-social btn-facebook btn-sm btn-flat" href="<?=base_url()?>facebooklogin">
                                <i class="fa fa-facebook"></i> Login with Facebook
                            </a>                   
                            </div>          
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well well-red">
                            <span class="yellow-font bold">' Generate Profile '</span>  will request the permission. <span class="yellow-font bold">Accept it !</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well well-red">
                            Your profile is <span class="yellow-font bold">READY !</span><br/>
                            Download and change your cool profile
                        </div>
                    </div>
            </div><!-- col-lg-12 -->
        </div><!-- row -->
        <br/>
        <br/>
    </div><!-- container -->






<div class="modal fade login" id="wantknowmodal" tabindex="-1" role="dialog" aria-labelledby="wantknowmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form role="form" method="post" id="flagform" action="<?=base_url()?>currency_rate/result_rate">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title bold" id="myModalLabel">I Want to Know</h4>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <div id="currency-check"></div>
                        <h5 class="pred-font bold">Please choose your country</h5><br/><br/>
                            <div class="row">
                            <?php
                                if(!empty($currens)){
                                    $x = 1;
                                    foreach($currens as $key=>$val){                                
                            ?>
                                <div class="col-md-2 radiogp">                            
                                    <input type="radio" class="radio_item" value="<?=$val['currency_id']?>" name="flag_item" id="<?=$key?>">
                                    <label class="label_item" for="<?=$key?>" data-toggle="tooltip" data-placement="top" data-original-title="<?=$val['country']?>"><img src="<?=base_url()?>uploads/<?=$val['img_file']?>" class="img-reponsive customimg" alt="<?=$val['country']?>"></label>
                                    <p class="blue-font"><?=$val['symbol']?></p>
                                </div>   

                            <?php } $x++; } ?>                                                                                                                                                        
                            </div>
                            <br/><br/>
                            <div id="currency-error"></div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer smfooter">
                <span class="pull-left">
                <span class="blue-font pull-left">Latest Best Rate :</span><br/>
                <?php if(!empty($trates)){ 
                    $x = count($trates);
                    $y = 1;
                ?>
                <span class="font14">
                <?php foreach($trates as $brow){?>
                    <?=$brow['symbol']?> - <span class="no bold font17"><?=$brow['rate']?></span> <?=($x == $y ? '' : '/')?>
                <?php $y++; } } else { echo ' - '; } ?>
                </span>
                </span>
                <?php
                    $date = date('d-m-Y');
                    $end  = date('d-m-Y',(strtotime ( '-3 day' , strtotime ( $date) ) ));
                ?>
                <input type="hidden" id="hidflag" name="currency_id" />
                <input type="hidden" name="start_date" value="<?=$end?>" />
                <input type="hidden" name="end_date" value="<?=$date?>" />
                <input type="hidden" id="type" name="htype" value="home" />
            </div>
        </div>
        </form>
    </div>
</div>

<script>
$(function(){

    $("[data-toggle='tooltip']").tooltip();

    $('.radio_item').on('click', function(){
        var tval = $(this).val();
        $('#hidflag').val(tval);
        $('#flagform').submit();
    }); 

    if ($('#msg').is(':visible') && $('#msg').html().trim()) {
        alert('Account successfully Activated!');
        window.location.href = base_url;   
    }

});
</script>