<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/jquery-ui.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<script src="<?= base_url();?>public/js/jquery-ui.js"></script>

<div class="container wtent">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="well">
                <h4 class="bold">Your Profile is ready!</h4><br/>
                <img src="<?=base_url()?>uploads/<?=$get_user['id']?>.jpg" /><br/><br/>
                <div>
                    <a href="<?=base_url()?>home/img_download/<?=$get_user['id']?>" class="btn btn-danger" download>Download Profile</a>
                </div>
                <br/><br/>
            </div>
        </div><!-- col-lg-10 -->
    </div><!-- row -->
</div><!-- container -->
