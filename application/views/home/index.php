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
                        <div class="well well-yellow">
                            Your profile picture is <span class="pred-font font20 bold">READY !</span><br/>
                            Download and change your profile
                        </div>
                    </div>
            </div><!-- col-lg-12 -->
        </div><!-- row -->
        <br/>
        <br/>
    </div><!-- container -->

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