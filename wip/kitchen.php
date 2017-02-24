<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Food</h1>
<?php
$lines = file("dump/kitchen.csv");
echo '<table id="tableItems">';
$cnt='odd';
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
	if (empty($l[0])||trim($l[0])=='') continue;
		if ($cnt=='odd')
		  $cnt='even';
		else $cnt='odd';
		
	if ($k == 106)
	{
	  echo '<tr><td colspan="100" style="height:10px;text-align:center;"><h1 style="margin-bottom:4px;">Effects</h1></td></tr>';
	}
  if ( in_array($k,array(0,40,76)) )
	{
	  echo '<tr><td colspan="100" style="height:10px"> &nbsp; </td></tr>';
	  echo '<tr>';
	  echo '<th colspan="2" class="heading">'.$l[0].'</th>';
		if ($k!=76)
		{
	  echo '<th colspan="2" class="heading">'.$l[3].'</th>';
	  echo '<th colspan="2" class="heading">'.$l[6].'</th>';
		}
		echo '</tr>';
	}	
	else if ( (count($l)>1 && trim($l[1])=='') || count($l)==1)
	{
	  if (!in_array($k,array(2,42,78)) )
	    echo '<tr><td colspan="100" style="height:10px"> &nbsp; </td></tr>';
	  echo '<tr>';
	  echo '<th colspan="2">'.$l[0].'</th>';
		if ($k<76)
		{
	  echo '<th colspan="2">'.$l[3].'</th>';
	  echo '<th colspan="2">'.$l[6].'</th>';		
		}
	  echo '</tr>';
		$cnt = 'even';
	}
	else
	{
	echo '<tbody class="'.$cnt.'"><tr>';
	foreach($l as $k2 => $v)
	{
	  $v = trim($v);
	  if ($v=='')
		  continue;
		else if ($k==106)
		  echo '<th>'.$v.'</th>';
		else if ($v == 'Japanese' || $v=='English')
		  echo '<td class="def" style="text-align:center;">'.$v.'</td>'; 
		else if ($k>108 && $k2==0)
		  echo '<td class="def">'.$v.'</td>';
		else 
	    echo '<td>'.$v.'</td>';
	}

	echo '</tr></tbody>';
	}//else
}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>
