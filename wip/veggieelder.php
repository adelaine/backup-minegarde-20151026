<?php
  include('include/soc_header.inc.php');
  if (!empty($_REQUEST['l']))
	switch ($_REQUEST['l'])
	{
	  case 'j' : $loc = 'Jungle'; $locfn = 'jungle'; break;
	  case 'd' : $loc = 'Desert'; $locfn = 'desert'; break;
	  case 'w' : $loc = 'Swamp'; $locfn = 'swamp'; break;
	  case 'f' : $loc = 'Forest and Hills'; $locfn = 'fnh'; break;
	  case 'n' : $loc = 'Kokoto Jungle'; $locfn = 'kktjungle'; break;
	  case 'p' : $loc = 'Kokoto Swamp'; $locfn = 'kktswamp'; break;
	  case 's' : default: $loc = 'Snowy Mountains'; $locfn = 'snwmtn'; break;
	}
	else 
	{
	  $loc = 'Snowy Mountains'; $locfn = 'snwmtn'; 
	}
	
?>
<center>
<h1>Veggie Elder Trade List: <?php echo $loc; ?></h1>
<a href="veggieelder.php?l=s">Snowy Mountain</a> |
<a href="veggieelder.php?l=d">Desert</a> |
<a href="veggieelder.php?l=j">Jungle</a> |
<a href="veggieelder.php?l=w">Swamp</a> |
<a href="veggieelder.php?l=f">Forest and Hills</a> |
<a href="veggieelder.php?l=n">Kokoto Jungle</a> |
<a href="veggieelder.php?l=p">Kokoto Swamp</a>
<br><br>
<?php 
$lines = file("dump/vtrade_".$locfn.".csv");
echo '<table id="tableItems">';
echo '<tr><th>&nbsp</th><th colspan="3">Unite</th><th>&nbsp</th><th colspan="3">Japanse</th><th>&nbsp</th><th>&nbsp</th><th colspan="3">Patch</th><th>&nbsp</th>';
echo '<tr style="white-space:nowrap;"><th>&nbsp</th><th>Item</th><th style="white-space:nowrap;text-align:center;">Trade 1 (80%)</th><th style="white-space:nowrap;text-align:center;">Trade 2 (20%)</th>';
echo '<th style="white-space:nowrap;">&nbsp</th><th>Item</th><th style="white-space:nowrap;text-align:center;">Trade 1 (80%)</th><th style="white-space:nowrap;text-align:center;">Trade 2 (20%)</th><th>&nbsp</th>';
echo '<th style="white-space:nowrap;">&nbsp</th><th>Item</th><th style="white-space:nowrap;text-align:center;">Trade 1 (80%)</th><th style="white-space:nowrap;text-align:center;">Trade 2 (20%)</th><th>&nbsp</th>';
echo '</tr>';
$cnt='odd';
array_splice($lines,0,1);
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
  if ($cnt == 'even')
	  $cnt = 'odd';
	else $cnt = 'even';
  echo '<tbody class="'.$cnt.'"><tr>';
	
	echo '<td style="white-space:nowrap;"> &nbsp; </td><td class="def" style="white-space:nowrap;text-align:center;">'.$l[0].'</td><td style="white-space:nowrap;text-align:center;">'.$l[1].'</td><td style="white-space:nowrap;text-align:center;">'.$l[2].'</td>';
	echo '<td style="white-space:nowrap;"> &nbsp; </td><td class="def" style="white-space:nowrap;text-align:center;">'.$l[4].'</td><td style="white-space:nowrap;text-align:center;">'.$l[5].'</td><td style="white-space:nowrap;text-align:center;">'.$l[6].'</td><td> &nbsp; </td>';
	echo '<td style="white-space:nowrap;"> &nbsp; </td><td class="def" style="white-space:nowrap;text-align:center;">'.$l[8].'</td><td style="white-space:nowrap;text-align:center;">'.$l[9].'</td><td style="white-space:nowrap;text-align:center;">'.$l[10].'</td><td> &nbsp; </td>';
	echo '</tr></tbody>';
}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>
