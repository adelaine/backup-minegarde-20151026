<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Carve Guide</h1>
<?php 
$lines = file("dump/Book1.csv");
echo '<table id="tableItems">';
$cnt='odd';
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
	if (empty($l[1])&&empty($l[2])&&empty($l[4])&&empty($l[6]))
	  continue;
	else if (!empty($l[1])&&empty($l[2])&&empty($l[4])&&empty($l[6]))
	{
	  echo '<tr><th style="font-weight:normal;text-align:left;">'.$l[1].'</th>';
		echo '<th>&nbsp</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th><th>&nbsp</th>';
		echo '</tr>';
		continue;
	}
  if ($cnt == 'even')
	  $cnt = 'odd';
	else $cnt = 'even';
  echo '<tbody class="'.$cnt.'"><tr>';

	foreach($l as $q => $r)
	if ($k == 0 && $q > 0)
	  echo '<th>'.$r.'</th>';
	else if ($q > 0)
	{
	  if (in_array($q, array('3','5','7')))
	    echo '<td class="percent">'.$r.'</td>';
		else
	    echo '<td>'.$r.'</td>';
	}
	echo '</tr></tbody>';
}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>