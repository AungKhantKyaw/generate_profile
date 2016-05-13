</div><!-- end container -->
</div>
    <!-- FOOTER -->
    <div id="f">
        <div class="container">
            <div class="row">
              <span class="pull-left wh-font font14">Copyright &copy; <?=date('Y')?> http://generateyourprofile.com</span>
              <span class="pull-right">
                <div class="fb-like" data-href="https://www.facebook.com/Generate-Your-Profile-176566499345318/" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
              </span>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- Footer -->

    <!-- MODAL FOR CONTACT -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form role="form" method="post" class="contactform" action="<?=base_url()?>home/send_message">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
          </div>
          <div class="modal-body">
                <div class="row centered">                    
                    
                      <div class="col-lg-10 col-lg-offset-1">
                        <div id="send-email-check"></div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input class="form-control input-sm" placeholder="E-mail" id="con-email" name="email" type="email" value="<?=($this->session->userdata('sgcurrency_email') != '' ? $this->session->userdata('sgcurrency_email') : '')?>">
                        </div>
                      </div>
                      <div class="col-lg-10 col-lg-offset-1">
                        <div id="send-message-check"></div>
                        <div class="form-group">
                            <textarea class="form-control tarea" id="remark" rows="5" name="remark" placeholder="Message"></textarea>
                        </div>
                         <div id="sendmsg-error"></div>             
                      </div> 
                             
                </div>
          </div>
          <div class="modal-footer">
             <button type="submit" class="btn btn-primary" id="btn-send">Send</button>
          </div>
        </div><!-- /.modal-content -->
         </form>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



<!-- end -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- plugin  -->

    <script src="<?=base_url()?>public/js/moment.js"></script>
    <script src="<?=base_url()?>public/js/bootstrap-datetimepicker.js"></script>
    <script src="<?=base_url(); ?>public/lib/alert/sweetalert.min.js"></script>
<script type="text/javascript">
var base_url = '<?=base_url()?>';
$(function(){

        $('#btn-send').on('click', function(e){
           e.preventDefault();
           var s_valid = true;
           var s_error_msg = '';
           var s_email = $('#con-email').val();
           var s_body  = $('#remark').val();
           

            if (s_email == '') {
                s_error_msg += 'Please key in your email.<br>';
                s_valid = false;
            }

            if (s_body == '') {
                s_error_msg += 'Please key in your message.<br>';
                s_valid = false;
            }

           
            if (!s_valid) {
                $('#sendmsg-error').removeClass();
                $('#send-email-check').removeClass();
                $('#send-email-check').html('');
                $('#sendmsg-error').addClass('alert alert-danger text-left');
                $('#sendmsg-error').html(s_error_msg);
                
            }
            else{
             
                $('#sendmsg-error').removeClass();
                $('#sendmsg-error').html('');
            }  
            if (s_valid) {
                  $.ajax({
                    type: "POST",
                    url: base_url + "home/send_message", 
                    data: { 
                      s_email    : s_email,
                      s_message  : s_body,                      
                    },
                    success: function(data){  
                      var result = $.parseJSON(data);
                      if(result['status'] == 'success') {
                          alert('Successfully send!');
                          window.location.href = base_url;          
                      }
                      else{
                            alert('Something wrong!');
                      }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                      alert("ERROR!!!");           
                    } 
                  });
            }          

        });



});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68290008-1', 'auto');
  ga('send', 'pageview');

</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=304401489730154";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
          
  </body>
</html>