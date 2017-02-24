<?php
  include('include/soc_header.inc.php');	
?>
<center>
<h1>Monster Abnormal Status Values Chart</h1>
<div style="width:600px;padding:20px;">
Here are the Abnormal Status Values for every monster 
in Monster Hunter Portable 2nd G. Int is the initial value, 
Inc is the increment value, Max is the maximum value, 
Dur is the duration and Dam for Poison Status is the total damage.
</div>
<?php 
$lines = file("dump/abnormal.csv");
echo '<style> #tableItems td { text-align: right; } #tableItems th { font-weight:normal; } </style>';
echo '<table id="tableItems">';
$cnt='odd';
foreach ($lines as $k => $l)
{
	$l = explode(',',$l);
  if ($cnt == 'even')
	  $cnt = 'odd';
	else $cnt = 'even';
	if (count($l)<3)
	{
	  $cnt = 'even';		
		//echo '<tr><td colspan="100" style="font-weight:bold;color:papayawhip;padding-top:10px;text-align:left;">'.$l[0].'</td><td colspan="100"> &nbsp; </td></tr>';
		echo '<tr><td><div style="height:10px" colspan="100"></td></tr>';
echo '<tr><th> &nbsp; </th><th style="font-weight:bold;">Monster</th><th> &nbsp; </th><th colspan="4" style="font-weight:bold;">Sleep</th><th> &nbsp; </th><th colspan="4" style="font-weight:bold;">Poison</th><th> &nbsp; </th><th colspan="4" style="font-weight:bold;">Paralyze</th><th> &nbsp; </th>';
echo '</tr><tr><th> &nbsp; </th><th style="color:papayawhip;text-align:left;">'.$l[0].'</th>';
echo '<th> &nbsp; </th><th>Int</th><th>Inc</th><th>Max</th><th>Dur</th>';
echo '<th> &nbsp; </th><th>Int</th><th>Inc</th><th>Max</th><th>Dmg</th>';
echo '<th> &nbsp; </th><th>Int</th><th>Inc</th><th>Max</th><th>Dur</th><th> &nbsp; </th>';
	}
	else
	{
  echo '<tbody class="'.$cnt.'"><tr>';
	echo '<td> &nbsp; </td>';
	echo '<td style="text-align:left;">'.$l[0].'</td>';
	echo '<td> &nbsp; </td>';
	echo '<td class="Slp">'.$l[1].'</td>'.'<td class="Slp">'.$l[2].'</td>'.'<td class="Slp">'.$l[3].'</td>';
	echo '<td class="def">'.$l[4].'</td>';
	echo '<td> &nbsp; </td>';
	echo '<td class="Poi">'.$l[5].'</td>'.'<td class="Poi">'.$l[6].'</td>'.'<td class="Poi">'.$l[7].'</td>';
	echo '<td class="def">'.$l[8].'</td>';
	echo '<td> &nbsp; </td>';
	echo '<td class="Par">'.$l[9].'</td>'.'<td class="Par">'.$l[10].'</td>'.'<td class="Par">'.$l[11].'</td>';
	echo '<td class="def">'.$l[12].'</td>';
	echo '<td> &nbsp; </td>';
	echo '</tr></tbody>';
	}
}
echo '</table>';
?>
<div style="width:600px;padding:20px;text-align:left;">
<p>Notes on Abnormal Status:</p>
<p>Bows can no longer inflict Abnormal Status when using melee attacks. If a monster is hit by a melee attack by the bow which has an Abnormal Status coating equipped, the monster will only receive Raw and Elemental (if applicable) damage, whilst the Abnormal Status Damage will have a null value.</p>
<p>Poison Status will decrease a monster's health at a certain rate, depending on the monster. A monster can only die from the Poison Status if it is in a certain area. When the monster is switching areas the Poison Status cannot make the monster's health go lower than 1, until the monster is locked into that area. This also applies if the monster is underground, the health will remain at 1 until it resurfaces.</p>
<p>Over time, monsters will decrease the amount of a certain Status within them at a constant rate. Monsters will decrease the Poison Status they have within themselves by 10, every 5 seconds. Monsters will decrease the Sleep Status they have within themselves by 5, every 10 seconds (except for Kirin which it decreases by 5, every 20 seconds). For the Paralysis Status, monsters have different rates.</p>
<p>Bouncing will not reduce the Abnormal Status damage inflicted on the monster.</p>
<p><span style="color:thistle">This data is provided by VioletKira.</span></p>
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>