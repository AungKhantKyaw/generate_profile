<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/jquery-ui.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<script src="<?= base_url();?>public/js/jquery-ui.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    // window.location.reload();
    // window.onbeforeunload = function(e) {
    //     window.location ='http://generateyourprofile.com/gen_img/generate_profile';
    //     return 'Are you sure want to exit.';
    // };
});
</script>
<div class="container wtent">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well">
                <?php if($msg != ''){ ?>
                <h4 class="bold">Your Profile is ready!</h4><br/>
                <img src="<?=base_url()?>uploads/<?=$get_user['id'] . $msg?>.jpg" /><br/><br/>
                <div>
                    <a href="<?=base_url()?>home/img_download/<?=$get_user['id'] . $msg?>" class="btn btn-danger" download>Download Profile</a>
                </div>
                <?php }else { header('Location: http://generateyourprofile.com/gen_img/generate_profile'); } ?>
                <br/><br/>
                <p>If you have any problem please read <a href="<?=base_url()?>home/faq" style="color:blue">FAQ.</a></p><br/>
            </div>
        </div><!-- col-lg-10 -->
    </div><!-- row -->
</div><!-- container -->
