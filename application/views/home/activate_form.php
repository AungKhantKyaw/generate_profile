<div class="container wb">
    <div class="row centered">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-lg-offset-1">
                    <h3 class="text-title detail-title align-left" style="margin-top:30px;">Activate your account</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                <div class="well">
                    <form method="post" action="<?=base_url()?>home/activate_account/<?=$id?>">     
                    <?php if(validation_errors()) { ?>
                        <div class="col-lg-10">
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= validation_errors();?></strong>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if(isset($msg) && $msg != '') { ?>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="alert alert-success" id="msg"><?php echo $msg; ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6"> 
                            <br/>
                            <div class="row">
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-bookmark-o"></i></span>
                                        <input class="form-control" placeholder="Activation Code" id="act_code" name="act_code" type="text" value="<?=$this->input->post('act_code')?>">
                                    </div>
                                </div>
                               
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                         <img src="<?php echo $captcha['image_src'];?>" alt="CAPTCHA security code" class=""/>                                        
                                         &nbsp;&nbsp; <a href="" id="reload-pg"><i class="fa fa-refresh"></i></a>
                                    </div>
                                </div>
                               
                                <div class="col-lg-11">
                                    <div class="form-group input-group">
                                         <input class="form-control" placeholder="CAPTCHA" id="captcha_code" name="captcha" type="text">
                                    </div>   
                                </div>
                                                         
                            </div>  
                        </div><!-- end side 1 -->
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-custom btn-block" id="btn-create-acc">Activate</button>
                            <br/>
                        </div>
                    </form>
                </div>
                </div>
            </div>         
        </div><!-- col-lg-12 -->
    </div><!-- row -->
</div><!-- container -->
<div class="blockarea">&nbsp;</div>
<br/><br/>
<script type="text/javascript">
var base_url = '<?=base_url()?>';
$(function(){

$('#reload-pg').click(function() {
    location.reload();
});


if ($('#msg').is(':visible') && $('#msg').html().trim()) {
    alert('Account Successfully Activate.Login and start using!');
    window.location.href = base_url;   
}

});
</script>