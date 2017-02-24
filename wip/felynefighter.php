<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Felyne Fighter Charts</h1>
<?php
$lines = file("dump/felynefighter.csv");
echo '<table id="tableItems">';
$cnt='odd';
$qflag = 0;
foreach ($lines as $k => $l)
{
	$l = explode(';',$l);
	if (empty($l[0])||trim($l[0])=='') continue;
        if (count($l)==1)
        {
	  echo '<tr><td colspan="100" style="height:10px"> &nbsp; </td></tr>';
	  echo '<tr>';
	  echo '<th colspan="100" class="heading">'.$l[0].'</th>';
          $qflag=1;
          continue;
        }
		if ($cnt=='odd')
		  $cnt='even';
		else $cnt='odd';



        echo '<tr>';
        foreach ($l as $k2 => $v)
        {
          if ($qflag==1)
          {
            echo '<th>'.$v.'</th>';
          }
          else if ($k2==0)
          {
            echo '<td class="def">'.$v.'</td>';
          }
          else 
          {
            echo '<td>'.$v.'</td>';
          }
        }
        echo '</tr>';

        if ($qflag==1)
        {
           $qflag=0;
           $cnt = 'odd';
        }

}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>
