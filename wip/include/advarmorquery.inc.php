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
	  $armfunc = 'showArmors2()';
		
	$query='';
	$skilsearch = getResult('SELECT * FROM armour_stats;');
	$matssearch = getResult('SELECT DISTINCT items.id, items.en FROM items JOIN armour_materials ON items.id = armour_materials.item_id ORDER BY items.id;');
	$tosearch='';
	if (!empty($_REQUEST))
	{
	if (!empty($_REQUEST['advSearch']))
	{
	  $query='';
	  if (!empty($_REQUEST['mindef']))
		{
		  if (!empty($query)) $query.=' AND ';
		  $query.='(def > '.$_REQUEST['mindef'].')';
		}
	  if (!empty($_REQUEST['slots']))
		{
		  if (!empty($query)) $query.=' AND ';
		  $query.='(slot > '.$_REQUEST['slots'].')';
		}
	  if (!empty($_REQUEST['rarity']))
		{
		  if (!empty($query)) $query.=' AND ';
			switch($_REQUEST['rarity'])
			{
			  case '1': case '2': case '3': case '4': case '5':  
			  case '6': case '7': case '8': case '9': case '10':  
				  $query.='rarity ='.$_REQUEST['rarity']; break;
				case 'A': 
				  $query.='rarity in (1,2,3,4,5)'; break;
				case 'B': 
				  $query.='rarity in (6,7,8)'; break;
				case 'C': 
				  $query.='rarity in (9,10)'; break;
			}
		}
	  if (!empty($_REQUEST['wclass']))
		{
		  if (!empty($query)) $query.=' AND ';
			if ($_REQUEST['wclass']=='1')
		    $query.='(wclass in (1,2))';
			else if ($_REQUEST['wclass']=='2')
		    $query.='(wclass in (1,3))';			
		}
	  if (!empty($_REQUEST['sex']))
		{
		  if (!empty($query)) $query.=' AND ';
			if ($_REQUEST['sex']=='1')
		    $query.='(sex in (1,2))';
			else if ($_REQUEST['sex']=='2')
		    $query.='(sex in (1,3))';			
		}
	  if (!empty($_REQUEST['istype']))
		{
		  if (!empty($query)) $query.=' AND ';
			$query.='(';
			$query.='aclass in (';
			foreach($_REQUEST['istype'] as $k => $l)
			{
			  if ($k>0) $query.= ',';
				$query.= $l;
			}
			$query.='))';
		}
	  if (!empty($_REQUEST['isres']))
		{
		  if (!empty($query)) $query.=' AND ';
			foreach($_REQUEST['isres'] as $k => $l)
			{
			  if ($k>0) $query.= ' AND ';
			  $query.='(';
				switch($l)
				{
				  case '0' : $query.='resF > 0'; break;
				  case '1' : $query.='resL > 0'; break;
				  case '2' : $query.='resW > 0'; break;
				  case '3' : $query.='resI > 0'; break;
				  case '4' : $query.='resD > 0'; break;
				}
			  $query.=')';
			}
		}
	  if (!empty($_REQUEST['hasskill']))
		{
 	    if (!empty($query)) $query.=' AND ';
			$qlist = getResult("SELECT DISTINCT armour_id FROM armour_skill WHERE skill_id = ".$_REQUEST['hasskill']." AND points>=0;");
		  if (!empty($qlist))
			{
			  $query.='id in (';
			  foreach($qlist as $k => $l)
			  {
			    if ($k>0) $query.=',';
					$query.=$l['armour_id'];
			  }
				$query.=')';
			}
		}
	  if (!empty($_REQUEST['hasskill2']))
		{
 	    if (!empty($query)) $query.=' AND ';
			$qlist = getResult("SELECT DISTINCT armour_id FROM armour_skill WHERE skill_id = ".$_REQUEST['hasskill2']." AND points>=0;");
		  if (!empty($qlist))
			{
			  $query.='id in (';
			  foreach($qlist as $k => $l)
			  {
			    if ($k>0) $query.=',';
					$query.=$l['armour_id'];
			  }
				$query.=')';
			}
		}
	  if (!empty($_REQUEST['hasmat']))
		{
 	    if (!empty($query)) $query.=' AND ';
			$qlist = getResult("SELECT armour_id FROM armour_materials WHERE item_id = ".$_REQUEST['hasmat'].";");
		  if (!empty($qlist))
			{
			  $query.='id in (';
			  foreach($qlist as $k => $l)
			  {
			    if ($k>0) $query.=',';
					$query.=$l['armour_id'];
			  }
				$query.=')';
			}
		}

	  if (!empty($_REQUEST['armorName']))
	  {
 	  if (!empty($query)) $query.=' AND ';
		$query.='(';
		$tosearch = preg_replace("/[^A-Za-z0-9\s\s+\*]/", "", urldecode($_REQUEST['armorName']));
		$tosearch = preg_replace('/\s\s+/', ' ', $tosearch);
	  $query.='en LIKE "%'.str_replace("*", "%", $tosearch).'%"';
		$query.=')';
	  }
		if (empty($query)) $query='0';
		$query= "SELECT * FROM armour WHERE ".$query." ORDER BY rarity DESC, aclass, def DESC LIMIT 15;";
	}
	else if (!empty($_REQUEST['armorName']))
	{
	  $tosearch = preg_replace("/[^A-Za-z0-9\s\s+\*]/", "", urldecode($_REQUEST['armorName']));
	  $tosearch = preg_replace('/\s\s+/', ' ', $tosearch);
    $query = 'SELECT * FROM armour WHERE en LIKE "%'.str_replace("*", "%", $tosearch).'%" ORDER BY rarity DESC, aclass, def DESC LIMIT 15;';
	}
	  $result = getResult($query);
	}	
		
?>
<style> .disabledstyle {color:#333333;} </style>
<table id="tableWeapons" cellpadding="0" cellspacing="0"><tr><th class="heading" colspan="100">Search for Armors</th></tr>
<tr><td class="s_odd" style="padding:0px 16px;text-align:left;" colspan="100"><div style="margin:4px 0px;">Enter text to search: <input id="armorName" value="<?php echo $tosearch; ?>"> <input type="button" value="Search Now" onClick="<?php echo $armfunc; ?>;">
<span style="color:#555555;font-size:8pt;margin-left:17px;">Use * for wildcard characters</span></div></tr></td>
<tbody id="simpleForm"><tr><td class="s_odd" style="padding:0px 16px;text-align:left;" colspan="100">
<a style="font-size:8pt;margin-left:17px;cursor:pointer;" onClick="document.getElementById('simpleForm').style.display='none';document.getElementById('advancedForm').style.display='';">Advanced &raquo; </span></td></tr></tbody>
<tbody id="advancedForm" style="display:none;"><tr><td class="s_odd" style="padding:0px 16px;text-align:left;" colspan="100">
<div style="margin:4px 0px;"><span class="def">Type</span> <input type="checkbox" name="istype[]" value="0">Helmet &nbsp;<input name="istype[]" type="checkbox" value="1">Plate &nbsp;<input name="istype[]" type="checkbox" value="2">Gauntlet &nbsp;<input name="istype[]" type="checkbox" value="3">Waist &nbsp;<input name="istype[]" type="checkbox" value="4">Leggings &nbsp;&nbsp;&nbsp;
</div>
<div style="margin:4px 0px;"><span class="def">Minimum Def</span> &nbsp; <input type="textbox" name="mindef" size="8" style="text-align:right;" onChange="this.value=parseInt(this.value);if (this.value=='NaN') this.value='';"/>
&nbsp;&nbsp;&nbsp; <span class="def">Resistant</span> 
<input type="checkbox" name="isres[]" value="0"><span class="Fir">Fir</span> &nbsp;
<input type="checkbox" name="isres[]" value="1"><span class="Thn">Thn</span> &nbsp;
<input type="checkbox" name="isres[]" value="2"><span class="Wat">Wat</span> &nbsp;
<input type="checkbox" name="isres[]" value="3"><span class="Ice">Ice</span> &nbsp;
<input type="checkbox" name="isres[]" value="4"><span class="Drg">Drg</span> &nbsp;
</div>
<div style="margin:4px 0px;"><span class="def">Used by</span> &nbsp; <select name="wclass"><option value="0">Any</option><option value="1">Blademaster</option><option value="2">Gunner</option></select>
<select name="sex"><option value="0">Any</option><option value="1">Male</option><option value="2">Female</option></select>
 &nbsp; &nbsp; &nbsp;
<span class="def">Slots</span> <select name="slots" style="font-family:Courier New, Courier;">
<option value="0">---</option>
<option value="1">O--</option>
<option value="2">OO-</option>
<option value="3">OOO</option>
</select>
 &nbsp; &nbsp; &nbsp;
<span class="def">Rarity</span> <select name="rarity">
<option value="0">Any</option>
<optgroup label="Low Rank">
  <option value="A">1-5</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
</optgroup>
<optgroup label="High Rank">
  <option value="B">6-8</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
</optgroup>
<optgroup label="G Rank">
  <option value="C">9-10</option>
  <option value="9">9</option>
  <option value="10">10</option>
</optgroup>
</select></div>
<div style="margin:4px 0px;"><span class="def">Skill 1</span> &nbsp; <select name="hasskill" id="isskill" onChange="x=document.getElementById('altskill'); if(this.value==0||this.value==1||this.value==2) {x.className='disabledstyle';x.disabled=true;x.value=0;} else {x.className='';x.disabled=false;}"><option value="0">Any</option>
<?php
  foreach($skilsearch as $k => $l)
	  echo '<option value="'.$l['id'].'">'.$l['en'].'</option>';
?></select> &nbsp;&nbsp;&nbsp;
<span class="def">Skill 2</span> &nbsp; <select name="hasskill2" id="altskill"><option value="0">Any</option>
<?php
  foreach($skilsearch as $k => $l)
	  if ($k==0||$k==1) continue; else
	  echo '<option value="'.$l['id'].'">'.$l['en'].'</option>';
?></select> </div>
<div style="margin:4px 0px;"><span class="def">Material</span> &nbsp; <select name="hasmat"><option value="0">Any</option>
<?php
  foreach($matssearch as $k => $l)
	  echo '<option value="'.$l['id'].'">'.$l['en'].'</option>';
?></select> <input type="button" value="Search Now" onClick="<?php echo $armfunc; ?>;"> </div>
<a style="font-size:8pt;margin-left:17px;cursor:pointer;clear:both;" onClick="document.getElementById('advancedForm').style.display='none';document.getElementById('simpleForm').style.display='';"> &laquo; Simple </span>
</td></tr>
</tbody>
<tr><td class="s_odd" style="padding:0px 16px;text-align:left;" colspan="100"><div style="height:4px;"></div></td></tr>
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
			echo '<td colspan="2" class="def">'.$armor['wclass'];
			if (!empty($armor['wclass']) && !empty($armor['sex'])) echo '<br>';
			echo $armor['sex'].'</td>';
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
				if ($a['id']<=2 || $a['points']==0)
				  echo '<span class="">'.$a['en'].'</span>';
				else if ($a['points']<0)
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
<script>x=document.getElementById('isskill').value; y=document.getElementById('altskill'); if (x==0||x==1||x==2) {y.className='disabledstyle';y.disabled=true;y.value=0;} else {y.className='';y.disabled=false;} </script>