<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
 <script>
  $(function(){
    /**
     *
     * URL Hack to work both for Searching & Pagination
     */
    $(".pagination li a").click(function(e){
        e.preventDefault();
        var currentUrl = window.location.href;
        var arr = currentUrl.split("?");
        if(typeof(arr[1]) != "undefined" && arr[1] !== null) {
          var newUrl = $(this).attr("href") +'?'+arr[1];
        }
        else {
          var newUrl = $(this).attr("href"); 
        }
        window.location.href = newUrl;
    });

    $(".delete-link").click(function(e){
      e.preventDefault();
      var url =  $(this).attr("href");
      var del_id = url.substring(url.lastIndexOf("/") + 1, url.length);
      $('#hid-delete-id').val(del_id);
      $("#delModal").modal('show');
     
    });

    $("#btn-confirm-yes").click(function(){
        var del_id= $('#hid-delete-id').val();
        $("#delModal").modal('hide');  
        window.location.replace("<?php echo base_url().'currency_rate/post_delete/'; ?>"+del_id);
    });

     $("[data-toggle='tooltip']").tooltip();
     $('#currency-select').select2();

      var d = new Date();
      d.setMonth(d.getMonth() - 1);
      var etwoDigitMonth = ((d.getMonth().length+1) === 1)? (d.getMonth()+1) : '0' + (d.getMonth()+1);
      var endDate = d.getDate() + "-" + etwoDigitMonth + "-" + d.getFullYear();


     $('#startdate').datetimepicker({
        format      :'D-M-YYYY',
        maxDate     : new Date(),
        
     });

     $('#enddate').datetimepicker({
        format      :'D-M-YYYY',
        maxDate     : new Date(),
        
     });

  });
</script>
<!-- Modal (For Confirm Delete)-->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Confirmation</h4>
      </div>
      <div class="modal-body">
        <span>Are you sure to delete this record?</span>
        <input type="hidden" name="hid-id" id="hid-delete-id" value=''/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id='btn-confirm-yes'>Yes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Model -->

<!--main content start-->
<div class="container wtent">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Post Listing
                    <div class="pull-right">
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($msg) && $msg != '') { ?>
                            <div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><?php echo $msg; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.row -->
                    <!-- search form -->
                    <div class="row">
                        <form role="form" action="<?=base_url()?>currency_rate/all_post">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="form-control input-sm" name="currency_id" id="currency-select">
                                        <option value="" selected>Select Currency</option>
                                        <?php if($currencys != '') { ?>
                                            <?php foreach($currencys as $cur) {  
                                                if( isset($_GET['currency_id']) && ($_GET['currency_id'] == $cur['currency_id']) ) {
                                                    echo "<option selected value='". $cur['currency_id'] . "' >" . strtoupper($cur['currency']) . '(' . $cur['symbol'] . ')' . "</option>";
                                                }
                                                else {
                                                    echo "<option value='". $cur['currency_id'] . "' >" . strtoupper($cur['currency']) . '(' . $cur['symbol'] . ')' . "</option>";
                                                }
                                            } ?>
                                        <?php } ?>
                                    </select>                                 
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <input type='text' class="form-control" id='startdate' name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" /> 
                            </div>
                            <div class="col-lg-2">
                                <input type='text' class="form-control" id='enddate' name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ('')  ; ?>"/>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-customa btn-sm">Search</button>
                            </div>
                       </form>
                    </div>
                    <!-- end search -->

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Currency</th>
                                    <th>Rate</th>
                                    <th>Address</th>
                                    <th>Location</th>
                                    <th>Post By</th>
                                    <th>Post Date</th>
                                    <th class="col-md-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($posts)): ?>
                            <?php foreach ($posts as $ps): ?>
                                <tr>
                                    <td><?=$ps->currency?></td>
                                    <td><?=$ps->rate?></td>
                                    <td><?=$ps->address?></td>
                                    <td><?=$ps->location?></td>
                                    <td><?=$ps->email?></td>
                                    <td><?=date('d M Y',$ps->post_date)?></td>
                                    <td>
                                        <a href="<?=base_url()?>currency_rate/post_edit/<?=$ps->post_id?>"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" data-original-title="Edit"></i></a>&nbsp
                                        <a href="<?=base_url()?>currency_rate/post_delete/<?=$ps->post_id?>" class="delete-link"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="left" data-original-title="Delete"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end panel -->
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-6 text-left">
                            <strong><?php echo $pagination_msg?></strong>
                        </div>
                        <div class="col-lg-6 text-right">
                            <?php echo $links; ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div><!-- container -->
<!--main content end-->