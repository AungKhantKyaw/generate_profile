<link href="<?= base_url();?>public/css/select2.css" rel="stylesheet">
<link href="<?= base_url();?>public/css/select2-bootstrap.css" rel="stylesheet">
<link href="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?= base_url();?>public/lib/tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url();?>public/js/select2.js"></script>
<div class="container wtent">
<br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Your Posts
                    <div class="pull-right">
                        <div class="btn-group">
                            <span class="topdate"><?=date('d M Y')?></span>&nbsp;<span id="txt"></span>
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
                    <form role="form" action="<?=base_url()?>currency_rate/your_post/<?=$uid?>" method="GET">
                    <div class="row">
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
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" name="location" id="location" data-role="tagsinput" placeholder="Type Location and hit Enter" value="<?php echo isset($_GET['location']) ? $_GET['location'] : ''; ?>">
                            </div>
                        </div>  
                        <div class="col-lg-2">
                            <div class="form-group">
                                <select class="form-control input-sm" name="sort_by">
                                    <option value=""> - Sort By Date - </option>
                                    <option value="asc" <?=isset($_GET['sort_by'])&&$_GET['sort_by']=='asc'?'selected':''?>>Ascending</option>
                                    <option value="desc" <?=isset($_GET['sort_by'])&&$_GET['sort_by']=='desc'?'selected':''?>>Descending</option>
                                </select>
                            </div>
                        </div>  
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>                                               
                    </div>
                </form><br/>                    
                    <div class="table-responsive"> 
                        <table class="table table-hover tbl_style">
                            <thead>
                                <tr>
                                    <th width="50px">Rate</th>
                                    <th width="220px">Location</th>
                                    <th width="120px">Remark</th>
                                    <th width="100px">Date</th>
                                    <th width="80px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if(!empty($userposts)){?>    
                        <?php foreach($userposts as $ups){ ?>                            
                                <tr>
                                    <td class="red-font bold font16">
                                        <?=($ups->decimal_no != 0 ? number_format($ups->rate,$ups->decimal_no) : number_format($ups->rate))?>
                                    </td>
                                    <td><span class="bold"><?=$ups->location?></span><br/>
                                        <span class="address_space">Address:<?=$ups->address?></span>
                                    </td>
                                    <td><?=$ups->remark?></td>
                                    <td><?= ($ups->post_date == 0 ? '' : date('d M h:i a',$ups->post_date)) ?></td>
                                    <td>
                                        <a href="<?=base_url()?>currency_rate/user_post_edit/<?=$ups->post_id?>"><i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="left" data-original-title="Edit"></i></a>&nbsp
                                        <a href="<?=base_url()?>currency_rate/user_post_delete/<?=$ups->post_id?>" class="delete-link"><i class="fa fa-trash-o" data-toggle="tooltip" data-placement="left" data-original-title="Delete"></i></a>
                                    </td>
                                </tr>
                        <?php } ?>
                        <?php } ?>                                                                                                                                                               
                            </tbody>
                        </table>
                    </div>
                </div>
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
<br/><br/><br/><br/>

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

<script type="text/javascript">
    $(function () {

     startTime();

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
        window.location.replace("<?php echo base_url().'currency_rate/user_post_delete/'; ?>"+del_id);
    });

     $('#startdate').datetimepicker({
        format      :'D-M-YYYY',
        maxDate     : new Date(),
        
     });

     $('#enddate').datetimepicker({
        format      :'D-M-YYYY',
        maxDate     : new Date(),
        
     });

    $("#currency-select").select2();

    $("[data-toggle='tooltip']").tooltip();

function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();

    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML = h+":"+m+":"+s;
    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}


});
</script>