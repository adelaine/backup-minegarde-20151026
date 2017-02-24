<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Armor Skills</h1>
<script type="text/javascript">
var hideJapFlag = false;
var hideUniteFlag = false;

function hideJap()
{
	if(!hideJapFlag)
	{
		hideJapFlag = true;
		var res = document.getElementsByName("jap");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="none";

	}
	else
	{
		hideJapFlag = false;
		location.reload(true);
		//var res = document.getElementsByName("jap");
		//var x = res.length;

		//for(var i =0 ; i < x; i++)
		//	res[i].style.display="inline";
	}
}

function hideUnite()
{
	if(!hideUniteFlag)
	{
		hideUniteFlag = true;
		var res = document.getElementsByName("unite");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="none";

	}
	else
	{
		hideUniteFlag = false;
		//var res = document.getElementsByName("unite");
		//var x = res.length;

		//for(var i =0 ; i < x; i++)
		//	res[i].style.display="block";
		location.reload(true);
	}
}
</script>
<input type="checkbox" onClick="hideJap();" value="false">Hide Japanese
<input type="checkbox" onClick="hideUnite();" value="false">Hide Unite<br><br>
<?php
$lines = file("dump/armorskillslist.csv");
echo '<table id="tableItems">';
//echo '<tr><th colspan="3"><b>Japanese</b></th><th>&nbsp</th><th colspan="4"><b>English</b></th></tr>';
//echo '<tr><th style="font-weight:normal;">Skill Points</th><th style="font-weight:normal;">Value<th style="font-weight:normal;">Skill Result</th>';
//echo '<th>&nbsp</th><th style="font-weight:normal;">Skill Points</th><th style="font-weight:normal;">Value<th style="font-weight:normal;">Skill Result</th><th style="font-weight:normal;">Description</th></tr>';
echo '<tr><th colspan="3" name="unite"><b>Unite English</b></th><th>&nbsp;</th><th colspan="3" name="jap"><b>Japanese</b></th><th>&nbsp;</th><th colspan="4"><b>2G English</b></th></tr>';
echo '<tr><th style="font-weight:normal;" name="unite">Skill Points</th><th style="font-weight:normal;" name="unite">Value<th style="font-weight:normal;" name="unite">Skill Result</th>';
echo '<th>&nbsp;</th><th style="font-weight:normal;white-space:nowrap;" name="jap">Skill Points</th><th style="font-weight:normal;" name="jap">Value<th style="font-weight:normal;" name="jap">Skill Result</th>';
echo  '<th>&nbsp</th><th style="font-weight:normal;">Skill Points</th><th style="font-weight:normal;">Value<th style="font-weight:normal;">Skill Result</th><th style="font-weight:normal;">Description</th></tr>';

$cnt='odd';
echo '<tbody class="'.$cnt.'">';
/*
foreach ($lines as $k => $l)
{
	$l = explode(';',$l);
	if ($k == 0 || count($l)<5)
	  continue;

	  echo '</tbody><tbody class="'.$cnt.'"';
		if ($cnt=='odd')
		  $cnt='even';
		else $cnt='odd';
	echo '<tr>';

	if($l[2] < 0)
	  $aff = 'affnegative';
	else
	  $aff = '';

	echo '<td class="def">'.$l[0].'</td>';
	echo '<td class="'.$aff.'" style="text-align:right;">'.$l[2].'</td>';
	echo '<td class="'.$aff.'">'.$l[3].'</td>';
	echo '<td class="invisible"></td>';
	echo '<td class="def">'.$l[1].'</td>';
	echo '<td class="'.$aff.'" style="text-align:right;">'.$l[2].'</td>';
	echo '<td class="'.$aff.'">'.$l[4].'</td>';
	echo '<td class="'.$aff.'" width="250px">'.$l[5].'</td>';


	echo '</tr>';
}
*/

foreach ($lines as $k => $l)
{
	$l = explode(';',$l); //BOOM! :D

	if ($k == 0 || count($l)<5)
	  continue;

	  echo '</tbody><tbody class="'.$cnt.'">';
		if ($cnt=='odd')
		  $cnt='even';
		else $cnt='odd';
	echo '<tr>';


	if($l[8] < 0)
	  $aff = 'affnegative';
	else
	  $aff = '';
/* Unite */
	echo '<td class="def" name="unite">'.$l[0].'</td>';
	echo '<td class="'.$aff.'" style="text-align:right;" name="unite">'.$l[8].'</td>';
	echo '<td class="'.$aff.'" name="unite">'.$l[1].'</td>';
	echo '<td class="invisible"></td>';
/* 2nd G*/
	echo '<td class="def" name="jap">'.$l[3].'</td>';
	echo '<td class="'.$aff.'" style="text-align:right;" name="jap">'.$l[8].'</td>';
	echo '<td class="'.$aff.'" style="white-space:nowrap;" name="jap">'.$l[4].'</td>';
	echo '<td class="invisible"></td>';
/*2nd G Eng*/
	echo '<td class="def">'.$l[6].'</td>';
	echo '<td class="'.$aff.'" style="text-align:right;">'.$l[8].'</td>';
	echo '<td class="'.$aff.'">'.$l[7].'</td>';
	echo '<td class="'.$aff.'" width="250px"><div style="width:200px">'.$l[9].'</div></td>';
	echo '</tr>';
}
echo '</table>';
?>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>
