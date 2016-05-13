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
    

    });
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<div class="container wtent">
<br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Currency Rate
                    <div class="pull-right">
                        <div class="btn-group">
                            <span class="topdate"><?=date('d M Y')?></span>&nbsp;<span id="txt"></span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?=base_url()?>currency_rate/result_rate_search" method="GET">
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
                                            else if( isset($hidcur) && ($hidcur == $cur['currency_id']) ) {
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
                        <?php
                            //$date = date('d-m-Y');
                            //$end  = date('d-m-Y',(strtotime ( '-3 day' , strtotime ( $date) ) ));
                        ?>
<!--                         <input type="hidden" name="start_date" value="<?=$end?>" />
                        <input type="hidden" name="end_date" value="<?=$date?>" />     -->                        
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
                                    <th width="100px">Share By</th>
                                    <th width="120px">Remark</th>
                                    <th width="100px">Date</th>
                                    <th width="80px">Share</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if(!empty($currency_rates)){?>    
                        <?php foreach($currency_rates as $crate){ ?>                            
                                <tr>
                                    <td class="red-font bold font16">
                                        <?php if($crate->decimal_no == 0){
                                            echo number_format($crate->rate);
                                        }
                                        else {
                                            echo number_format($crate->rate,$crate->decimal_no);
                                        }
                                        ?>
                                    </td>
                                    <td><span class="bold"><?=$crate->location?></span><br/>
                                        <span class="address_space">Address:<?=$crate->address?></span>
                                    </td>
                                    <td>
                                        <?php
                                            $split = explode('@',$crate->email);
                                            echo $split[0]; 
                                        ?>
                                    </td>
                                    <td><?=$crate->remark?></td>
                                    <td><?= ($crate->post_date == 0 ? '' : date('d M h:i a',$crate->post_date)) ?></td>
                                    <td>
                                        <a class="btn btn-sm btn-primary share" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=base_url()?>currency_rate/share_facebook/<?=$crate->post_id?>">
                                            <i class="fa fa-facebook"></i>
                                        </a> 
<?php
$tweet_url = base_url();
$text = '1 SGD - ' . $crate->rate . '(' . $crate->currency . ') ' . $crate->location;
$via  = 'sgcurrencyrate';
?>                              
<a href="<?=$tweet_url?>" title="<?=$text?>" class="tweet btn btn-sm btn-info share" alt="<?=$via?>" target="_blank"><i class="fa fa-twitter"></i></a>


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
<script type="text/javascript">
    $(function () {
        startTime();

        $('#datetimepicker5').datetimepicker({
            format      :'D-M-YYYY h:mm A',
            maxDate     : new Date(),
            defaultDate : new Date(),
        });

        $("#currency-select").select2();

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

$('a.tweet').click(function(e){

  //We tell our browser not to follow that link
  e.preventDefault();

  //We get the URL of the link
  var loc = $(this).attr('href');

  //We get the title of the link
  var title  = encodeURIComponent($(this).attr('title'));

  var datavia = encodeURIComponent($(this).attr('alt'));

  //We trigger a new window with the Twitter dialog, in the middle of the page
  window.open('http://twitter.com/share?url=' + loc + '&text=' + title + '&via=' + datavia + '&', 'twitterwindow', 'height=450, width=550, top='+($(window).height()/2 - 225) +', left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');

});


    });
</script>

