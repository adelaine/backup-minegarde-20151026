<?php
  include('include/soc_header.inc.php');
  if (!empty($_REQUEST['l']))
	switch ($_REQUEST['l'])
	{
	  case 'j' : $loc = 'Jungle'; $locfn = 'jungle'; break;
	  case 'd' : $loc = 'Desert'; $locfn = 'desert'; break;
	  case 'w' : $loc = 'Swamp'; $locfn = 'swamp'; break;
	  case 'f' : $loc = 'Forest and Hills'; $locfn = 'fnh'; break;
	  case 'v' : $loc = 'Volcano'; $locfn = 'volcano'; break;
	  case 'o' : $loc = 'Old Forest'; $locfn = 'oldfst'; break;
	  case 's' : default: $loc = 'Snowy Mountains'; $locfn = 'snwmtn'; break;
	}
	else
	{
	  $loc = 'Snowy Mountains'; $locfn = 'snwmtn';
	}

$lines = file("dump/tha_".$locfn.".csv");
echo '<table id="tableItems">';
$cnt='odd';
$qflag = 0; $mflag=0; $colnum=6;

while (empty($lines[0]))
  array_splice($lines,0,1);

?>

<center>
<h1>Treasure Hunting Guide : <?php echo $lines[0]; array_splice($lines,0,1); ?></h1>
<a href="treasure.php?l=s">Snowy Mountain</a> |
<a href="treasure.php?l=d">Desert</a> |
<a href="treasure.php?l=j">Jungle</a> |
<a href="treasure.php?l=w">Swamp</a> |
<a href="treasure.php?l=f">Forest and Hills</a> |
<a href="treasure.php?l=v">Volcano</a> |
<a href="treasure.php?l=o">Old Forest (Sea of Trees)</a>
<?php
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
        if (count($l)==1&&(empty($l[0])||trim($l[0])=='')) continue;
	//else if (empty($l[0])||trim($l[0])=='') continue;
        if (count($l)==1)
        {
          $colnum = count(explode(',',$lines[$k+1]));
	  echo '<tr><td colspan="100" style="height:10px"> &nbsp; </td></tr>';
	  echo '<tr>';
	  echo '<th colspan="'.$colnum.'" class="heading">'.$l[0].'</th>';
          $qflag=1;
          continue;
        }
        if ($l[0]=='Monsters')
        {
	  echo '<tr><td colspan="100" style="height:10px;white-space:nowrap;text-align:center"> &nbsp; </td></tr>';
	  echo '<tr>';
	  echo '<th colspan="100" class="heading">'.$l[0].'</th>';
          $qflag=1;
          $mflag=1;
        }
        if (!(empty($l[0])||trim($l[0])=='')&&!$mflag)
          $qflag=1;

		if ($cnt=='odd')
		  $cnt='even';
		else $cnt='odd';



        echo '<tr>';
	$tracker = 0;
        foreach ($l as $k2 => $v)
        {
	
          if ($qflag==1)
          {
		/*making %chance smaller*/
		if(($tracker ==6 || $tracker == 11))
			echo '<th style="font-size:10px;"><nobr>'.$v.'</nobr></th>';
		else
            		echo '<th><nobr>'.$v.'</nobr></th>';
            $tracker++;
          }
          else
          {
            echo '<td class="'.$cnt.'" style="white-space:nowrap;text-align:center">'.$v.'</td>';
          }
        }
        if ($mflag)
          while ($k2<9)
          { echo '<td class="'.$cnt.'"> &nbsp; </td>'; $k2++; }
        echo '</tr>';

        if ($qflag!=0)
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
