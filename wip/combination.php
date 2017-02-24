<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Combination Guide</h1>
<?php 
$lines = file("dump/combi.csv");
echo '<table id="tableItems">';
echo '<tr><th>&nbsp</th><th>&nbsp</th><th>Item</th><th>Result</th><th style="white-space:nowrap;">Success %</th><th colspan="2">Materials</th><th>&nbsp</th>';
echo '</tr>';
$cnt='odd';

$arrSub = explode(',',$lines[0]);
array_splice($lines,0,1);

foreach ($lines as $k => $l)
{
  $acls='';
  if ($k>=$arrSub[2])
	{
	  if ($k==$arrSub[2])
	    echo '<tr><td colspan="100" style="text-align:center;padding-top:10px;color:lemonchiffon;"><b>Alchemy</b></td></tr>';
		$acls='rare8';
	}
	else if ($k>=$arrSub[1])
	{
	  if ($k==$arrSub[1])
	    echo '<tr><td colspan="100" style="text-align:center;padding-top:10px;color:lemonchiffon;"><b>Treasure Hunting</b></td></tr>';
		$acls='Par';
	}
	
	$l = explode(',',$l);
  if ($cnt == 'even')
	  $cnt = 'odd';
	else $cnt = 'even';
  echo '<tbody class="'.$cnt.'"><tr><td><div></div></td>';
	echo '<td  class="'.$acls.'" style="text-align:right">';
  if (substr($l[1],0,1)=='*' || $acls=='Par') echo '* ';
	echo ($k+1).'</td>';
	echo '<td class="'.$acls.'">';
	echo $l[2].'</td>';
	echo '<td class="rare4" style="text-align:center;">'.$l[3].'</td>';
	if ($l[4] > 95) $chans = 'def';
	else if ($l[4] > 85) $chans = '';
	else if ($l[4] > 70) $chans = 'rare9';
	else if ($l[4] > 60) $chans = 'rare7';
	else if ($l[4] > 50) $chans = 'rare8';
	else $chans = '';
	echo '<td class="'.$chans.'" style="text-align:center;">'.$l[4].'%</td>';
	echo '<td>'.$l[5].'</td>';
	echo '<td>'.$l[6].'</td>';
	
	echo '<td><div></div></td></tr></tbody>';
}
echo '<tr><td colspan="100">';
echo '* indicates items that may only be combined in the field.';
echo '<br><br>Special Thanks to Boldrin and Croda for providing this information.';

echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>