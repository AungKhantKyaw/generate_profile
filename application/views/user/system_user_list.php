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
        window.location.replace("<?php echo base_url().'user/delete_sys_user/'; ?>"+del_id);
    });

    $("[data-toggle='tooltip']").tooltip();

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
                <div class="panel-heading">System User Listing
                    <div class="pull-right">
                        <div class="btn-group upp">
                            <a class="btn btn-primary btn-md" href="<?=base_url()?>user/system_user_create"><i class="fa fa-plus"></i> Add</a>
                        </div>
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
                        <form role="form" action="<?=base_url()?>user/system_user">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <input class="form-control input-sm" name="name" placeholder="Name" value="<?=isset($_GET['name'])?$_GET['name']:''?>">
                                </div>
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
                                    <th>Name</th>
                                    <th class="col-md-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($system_users)): ?>
                            <?php foreach ($system_users as $cur): ?>
                                <tr>
                                    <td><?=strtoupper($cur->admin_name)?></td>
                                    <td>
                                        <a href="<?=base_url()?>user/system_user_edit/<?=$cur->admin_id?>"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" data-original-title="Edit"></i></a>&nbsp
                                        <a href="<?=base_url()?>user/delete_sys_user/<?=$cur->admin_id?>" class="delete-link"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="left" data-original-title="Delete"></i></a>
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