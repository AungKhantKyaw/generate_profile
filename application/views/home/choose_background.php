    <div class="container wb">
        <div class="row centered">
            <div class="col-lg-10 col-lg-offset-1">
                <h1 class="upptxt big-font">
                   SELECT YOUR BACKGROUND
                </h1>

            </div><!-- col-lg-10 -->
        </div><!-- row -->
    </div><!-- container -->

    <div class="container">
        <div class="row">
            <div class="col-lg-12"> 
                <div class="row stylish-panel">
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>nld_bg.png" alt="National League for Democracy" class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">NLD FLAG</h2><br/>         
                      <a href="<?=base_url()?>gen_img/output_profile/nld" class="btn btn-danger gen" id="nld" title="Generate">Generate »</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>shan.png" alt="Shan Flag" class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">Shan</h2><br/>          
                      <a href="<?=base_url()?>gen_img/output_profile/shan" class="btn btn-danger gen" id="shan" title="Generate">Generate »</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>manu_bg.png"  class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">Man Utd</h2><br/>
                       <a href="<?=base_url()?>gen_img/output_profile/manu1" class="btn btn-danger gen" id="manu1" title="Generate">Generate »</a>
                      <br/>          
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>nld_bg2.png"  class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">NLD 2</h2>
                      <a href="<?=base_url()?>gen_img/gen_black_n_white/" class="btn btn-danger gen" id="nld2" title="Generate">Generate »</a>
                      <br/>          
                    </div>
                  </div>
                </div>
            </div><!-- col-lg-12 -->
        </div><!-- row -->
        <br/>
        <br/>
    </div><!-- container -->

<script>
$(function(){
    var burl = "<?=base_url()?>";
    $("[data-toggle='tooltip']").tooltip();
});
</script>