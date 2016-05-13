<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find and share the best exchange currency rate in Singapore">
    <meta name="keywords" content="currency,rate,Exchange rate,Exchange currency rate,singapore currency exchange rate">
    <meta name="author" content="">

    <meta property="og:title" content="SGCurrencyRate | FIND THE BEST EXCHANGE RATE IN SINGAPORE" />
    <meta property="og:site_name" content="SG Currency Rate" />
    <meta property="og:description" content="1 SGD - <?=($curren['currency_id'] == 2 ? $curren['rate'] : number_format($curren['rate'],2))?> (<?=$curren['currency']?>) / <?=$curren['location']?>" />
    <meta property="og:image" content="http://sgcurrencyrate.com/public/img/fb_fetch_logo.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://sgcurrencyrate.com/currency_rate/share_facebook/<?=$curren['post_id']?>">

    <link rel="shortcut icon" href="<?=base_url()?>public/img/favicon.ico">

    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:title" content="SGCurrencyRate | FIND THE BEST EXCHANGE RATE IN SINGAPORE"/>
    <meta name="twitter:domain" content="SGCurrencyRate"/>

    <title>SG CURRENCY RATE / SINGAPORE CURRENCY RATE</title>

<script language=javascript>
function redirect(){
  window.location = "http://sgcurrencyrate.com";
}
</script>

</head>
<body onload="redirect()">
&nbsp;
</body>
</html>