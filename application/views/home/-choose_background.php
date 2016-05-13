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
                      <img src="<?=base_url()?>bg_1.png" alt="Effect-1" class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">Effect 1</h2><br/>          
                      <a href="<?=base_url()?>gen_img/output_profile/effect1" class="btn btn-danger gen" id="effect1" title="Generate">Generate »</a>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>public/img/coming_soon.png"  class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">Coming Soon</h2>
                      <br/>          
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div>
                      <img src="<?=base_url()?>public/img/coming_soon.png"  class="img-circle img-thumbnail customsize">
                      <h2 class="ch_title">Coming Soon</h2>
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