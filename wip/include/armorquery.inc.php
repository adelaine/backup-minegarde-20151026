<?php
  if (!defined('INCLUDED'))
	{
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	  require_once('../../foundry/includes/config.php');
	  require_once('../../foundry/includes/utils.php');
	}
	else
	{
	  require_once('../foundry/includes/config.php');
	  require_once('../foundry/includes/utils.php');
	}
	
	$tosearch='';
	if (!empty($_REQUEST))
	if (!empty($_REQUEST['armorName']))
	{
		$tosearch = preg_replace("/[^A-Za-z0-9\s\s+\*]/", "", urldecode($_REQUEST['armorName']));
		$tosearch = preg_replace('/\s\s+/', ' ', $tosearch);
	  $query = 'SELECT * FROM armour WHERE en LIKE "%'.str_replace("*", "%", $tosearch).'%" LIMIT 15;';
	  $result = getResult($query);
	}
?>
<table id="tableWeapons" cellpadding="0" cellspacing="0"><tr><th class="heading" colspan="100">Search for Armors</th></tr>
<tr><td class="s_odd" style="padding:0px 16px;text-align:left;" colspan="100">Enter text to search: <input id="armorName" value="<?php echo $tosearch; ?>"> <input type="button" value="Search Now" onClick="showArmors();">
<span style="color:#555555;font-size:8pt;margin-left:17px;">Use * for wildcard characters</td></tr>
<?php
  //print results here
	if (!empty($result))
	{
	  echo '<tr><td style="height:14px;"><div></div></td></tr><tr><th class="heading" colspan="100">Results</th></tr>';
		echo '<tr><th class="mini"><div></div></th><th class="mini">Name</th><th class="mini">Type</th><th class="mini" colspan="2">User</th><th class="mini">Price</th>';
		echo '<th class="mini" colspan="4">Attributes</th>';
		echo '<th class="mini">Slots</th><th class="mini">Skills</th><th class="mini">Materials</th><th class="mini">Rarity</th><th class="mini"><div></div></th></tr>';
		
		foreach ($result as $key => $armor)
		{
		  $askills = getResult("SELECT * FROM armour_skill JOIN armour_stats ON armour_skill.skill_id = armour_stats.id WHERE armour_skill.armour_id = ".$armor['id']." ORDER BY points DESC;");
			$amats = getResult("SELECT * FROM armour_materials JOIN items ON armour_materials.item_id = items.id WHERE armour_materials.armour_id = ".$armor['id'].";");
		  if ($key%2) $tdclass='even'; else $tdclass='odd';
			switch($armor['aclass'])
			{
			  case '0': $armor['aclass'] = 'Helmet'; break;
			  case '1': $armor['aclass'] = 'Plate'; break;
			  case '2': $armor['aclass'] = 'Gauntlets'; break;
			  case '3': $armor['aclass'] = 'Waist'; break;
			  case '4': $armor['aclass'] = 'Leggings'; break;
			  default : $armor['aclass'] = '<span style="color:#999999;font-size:8pt;"><i>-</i></span>'; break;
			}
			switch($armor['sex'])
			{
			  case '1' : $armor['sex'] = ''; break;
			  case '2' : $armor['sex'] = 'Male Only'; break;
			  case '3' : $armor['sex'] = 'Female Only'; break;
			  default : $armor['sex'] = '<span style="color:#999999;font-size:8pt;"><i>-</i></span>'; break;
			}
			switch($armor['wclass'])
			{
			  case '1' : $armor['wclass'] = ''; break;
			  case '2' : $armor['wclass'] = 'Blademaster'; break;
			  case '3' : $armor['wclass'] = 'Gunner'; break;
			  default : $armor['wclass'] = '<span style="color:#999999;font-size:8pt;"><i>-</i></span>'; break;
			}
			switch($armor['slot'])
			{
			  case '0': $armor['slot'] = '---'; break;
			  case '1': $armor['slot'] = 'O--'; break;
			  case '2': $armor['slot'] = 'OO-'; break;
			  case '3': $armor['slot'] = 'OOO'; break;
			  default : $armor['slot'] = '<span style="color:#999999;font-size:8pt;"><i>-</i></span>'; break;
			}
			if ($armor['price']<1) $armor['price']= '<span style="color:#999999;font-size:8pt;"><i>-</i></span>'; else $armor['price'].='z';
			if ($armor['rarity']<1) $armor['rarity']= '<span style="color:#999999;font-size:8pt;"><i>-</i></span>';
			
		  echo '<tbody class="'.$tdclass.'"><tr valign="top">';
			echo '<td><div style="width:4px;"></div></td>';
			echo '<td style="text-align:left;padding-left:10px;"  class="rare'.$armor['rarity'].'">'.$armor['en'].'<br> &nbsp;<span style="color:#555555;font-size:8pt;">('.$armor['jp'].')</span></td>';
			echo '<td>'.$armor['aclass'].'</td>';
			echo '<td>'.$armor['wclass'].'</td>';
			echo '<td>'.$armor['sex'].'</td>';
			echo '<td>'.$armor['price'].'</td>';
			echo '<td style="text-align:left;color:#777777;padding-left:4px;">Def<br>Fir<br>Thn<br></td><td style="text-align:left;padding-left:0;white-space:nowrap;">';
			echo ': <span class="def">'.$armor['def'].'</span><br>';
			if ($armor['resF']<0) $negaff='affnegative'; else $negaff='';
			echo ': <span class="'.$negaff.'">'.$armor['resF'].'</span><br>';
			if ($armor['resL']<0) $negaff='affnegative'; else $negaff='';
			echo ': <span class="'.$negaff.'">'.$armor['resL'].'</span>';
			echo '<td style="text-align:left;color:#777777;padding-left:4px;">Wat<br>Ice<br>Drg<br></td><td style="text-align:left;padding-left:0;white-space:nowrap;">';
			if ($armor['resW']<0) $negaff='affnegative'; else $negaff='';
			echo ': <span class="'.$negaff.'">'.$armor['resW'].'</span><br>';
			if ($armor['resI']<0) $negaff='affnegative'; else $negaff='';
			echo ': <span class="'.$negaff.'">'.$armor['resI'].'</span><br>';
			if ($armor['resD']<0) $negaff='affnegative'; else $negaff='';
			echo ': <span class="'.$negaff.'">'.$armor['resD'].'</span>';
			echo '</td>';
			echo '<td>'.$armor['slot'].'</td>';
			echo '<td style="text-align:left;">';
			if (!empty($askills))
			foreach ($askills as $k => $a)
			{
			  if ($k>0) echo '<br>';
				if ($a['points']<0)
					echo '<span class="affnegative">'.$a['en'].' '.$a['points'].'</span>';
				else
					echo '<span class="">'.$a['en'].' +'.$a['points'].'</span>';
			}
			echo '</td>';
			echo '<td style="text-align:left;">';
			if (!empty($amats))
			foreach ($amats as $k => $a)
			{
			  if ($k>0) echo '<br>';
					echo $a['en'].': <span class="rare4">'.$a['qty'].'</span>';
			}
			echo '</td>';
			echo '<td class="rare'.$armor['rarity'].'">'.$armor['rarity'].'</td>';
			echo '<td><div style="width:4px;"></div></td>';
			echo '</tr></tbody>';
			echo '<tr><td colspan=100 style="height:1px;margin:0;padding:0;"></td></tr>';
		}
		if (count($result) > 14)
		echo '<tr><td class="s_odd" style="padding:8px 16px;" colspan="100">Too many results. Other results have been omitted.</td></tr>';
	}
	else if (!empty($_REQUEST))
	{
	  echo '<tr><td style="height:4px;"><div></div></td></tr><tr><th class="heading" colspan="100">Results</th></tr>';
		echo '<tr><td class="s_odd" style="padding:8px 16px;" colspan="100">No Results Found</td></tr>';
	}
?>
</table>