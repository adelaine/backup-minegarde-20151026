<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Items List</h1>
<?php 
$lines = file("dump/ItemsTrans.csv");
echo '<table id="tableItems">';
//echo '<tr><th>&nbsp</th><th>Japanese</th><th>&nbsp</th><th>English</th><th>&nbsp</th><th>Chinese</th><th>&nbsp</th>';
echo '<tr><th>&nbsp;</th><th>Unite English</th><th>&nbsp;</th><th>Japanese</th><th>&nbsp;</th><th>2G English</th><th>&nbsp;</th>';
echo '</tr>';
$cnt='odd';
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
  if ($cnt == 'even')
	  $cnt = 'odd';
	else $cnt = 'even';
  echo '<tbody class="'.$cnt.'"><tr>';

	foreach($l as $q => $r)
	{
	  if ($q == 2)
	    echo '<td class="def">'.$r.'</td>';
	  else if ($q > 0)
	    echo '<td>'.$r.'</td>';
	  echo '<td>&nbsp</td>';
	}
	echo '</tr></tbody>';
}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>
