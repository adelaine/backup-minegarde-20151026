<?php
include ('include/soc_header.inc.php');
echo '<link rel="stylesheet" type="text/css" href="css/sf_felynefighters.css" />';

error_reporting(0);
$contents = '';
//$handle = fopen('http://forums.minegarde.com/index.php?act=home','r');
if(0 && !empty($handle)){
   while (!feof($handle)) {
   $contents .= fread($handle, 8192);}
fclose($handle);
$startpos = strpos($contents,"<b>Latest News</b>");
$endpos = strrpos($contents,"View Comments</a>");
echo substr($contents, $startpos+230, $endpos-$startpos-156);
}
else{
echo '<h1>Please bear with us.</h1>';
echo '<p>The IPBFree server has permanently gone down. We are currently working on a new forum, which is up and operational; however because we have lost ALL DATA, you will have to re-register your nick.<p>The weaponsmith, armory, and other guides are still available.';
}
?>
<script type="text/javascript">
  x = document.getElementsByTagName('div');
  for (i=0; i<x.length;i++)
  {
    if (x[i].className=='maintitle')
    {
      x[i].style.backgroundPosition='0px 21px';
      x[i].innerHTML='<div class="maintitle_left"><div class="maintitle_right"><div style="height:26px;"></div>'+x[i].innerHTML+'</div></div>';
     }
  }
  x = document.getElementsByTagName('td');
  for (i=0; i<x.length;i++)
  {
    if (x[i].className=='maintitle')
    {
      x[i].style.backgroundPosition='0px 21px';
      x[i].innerHTML='<div class="maintitle_left"><div class="maintitle_right"><div style="height:26px;"></div>'+x[i].innerHTML+'</div></div>';
     }
  }
  document.getElementById('menubk').style.margin='40px 0px';
  document.getElementById('headertdfix').style.width='170px';
  document.getElementById('bodytdfix').style.width='170px';
  document.getElementById('menubk').style.display='';
</script>


</div>
</center>

<?php

include ('include/soc_footer.inc.php');
?>
