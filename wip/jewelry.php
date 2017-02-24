<?php
  include('./include/zfunc.php');
  include('include/soc_header.inc.php');
  mg_dbconnect();

   
   $by='';
   $act='';
   $act2='';
   $order='';
   $extra = '';
   $query = "SELECT * FROM jewels ";
   $ORDERBY = "ORDER BY id";

   if((isset($_GET['searchDec']) && $_GET['searchDec'] != '') || isset($_GET['act']))
   {
      $act = "search";
      if($act =="search")
      {
         $extra.="&act=search";
         //Now we need to build the query and get the other informations

         //check if it is worth doing a where clause
         if(
            (isset($_GET['skill'])  && $_GET['skill'] != "Any")    || 
            (isset($_GET['wclass']) && $_GET['wclass'] != "Any")   || 
            (isset($_GET['slots'])  && $_GET['slots'] != "Any")    || 
            (isset($_GET['rarity']) && $_GET['rarity'] != "Any")   ||
            (isset($_GET['hasmat1']) && $_GET['hasmat1'] != "Any") ||
            (isset($_GET['hasmat2']) && $_GET['hasmat2'] != "Any") ||
            (isset($_GET['hasmat3']) && $_GET['hasmat3'] != "Any") ||
            (isset($_GET['hasmat4']) && $_GET['hasmat4'] != "Any")
         )
         {


               $prevStatSet = false;
            

               $skill = mysql_real_escape_string($_GET['skill']);
               $wclass = mysql_real_escape_string($_GET['wclass']);
               $slots = mysql_real_escape_string($_GET['slots']);
               $rarity = mysql_real_escape_string($_GET['rarity']);
               $mat1 = mysql_real_escape_string($_GET['hasmat1']);
               $mat2 = mysql_real_escape_string($_GET['hasmat2']);
               $mat3 = mysql_real_escape_string($_GET['hasmat3']);
               $mat4 = mysql_real_escape_string($_GET['hasmat4']);

               if($skill != "Any")
               {
                  $query.= " WHERE `Stat1` = '$skill' ";
                  $prevStatSet = true;
               }
               
               if($wclass != "Any")
               {
                  if($prevStatSet == true)
                     $query.=" AND ";
                  else
                     $query.=" WHERE ";
                  $query.=" (`HunterType` = '$wclass' or `HunterType` = 'Both') ";
         
                  $prevStatSet = true;
               }

               if($slots != "Any")
               {
                  if($prevStatSet == true)
                     $query.=" AND ";
                  else
                     $query.=" WHERE ";

                  $query.=" `SlotsRequired` = '$slots' ";
                  $prevStatSet = true;         
               }
               
               if($rarity != "Any")
               {
                  if($prevStatSet == true)
                     $query.=" AND ";
                  else
                     $query.=" WHERE ";

                  $query.=" `Rarity` = '$rarity' ";
                  $prevStatSet = true;         
               }


               //Now for the Hard part. We want to see how many Materials they have
               //set
               $matSet = 0;
               $material = array();
               if($mat1 != "Any"){ $matSet++; array_push($material, $mat1);}
               if($mat2 != "Any"){ $matSet++; array_push($material, $mat2);}
               if($mat3 != "Any"){ $matSet++; array_push($material, $mat3);}
               if($mat4 != "Any"){ $matSet++; array_push($material, $mat4);}
               
               if($matSet != 0)
               {
                  $query .= zpermute($matSet,$material, $prevStatSet);
      
               }
               $extra .="&amp;skill=$skill&amp;wclass=$wclass&amp;slots=$slots";
               $extra .="&amp;rarity=$rarity&amp;hasmat1=$mat1&amp;hasmat2=$mat2";
               $extra .="&amp;hasmat3=$mat3&amp;hasmat4=$mat4";

        }
      
      }
   }
/*
`UniteNames` VARCHAR( 15 ) NOT NULL ,
`2gNames` VARCHAR( 15 ) NOT NULL ,
`Price` VARCHAR( 10 ) NOT NULL ,
`SlotsRequired` VARCHAR( 3 ) NOT NULL ,
`Rarity` VARCHAR( 1 ) NOT NULL ,
`HunterType` VARCHAR( 15 ) NOT NULL ,
`Stat1` VARCHAR( 15 ) NOT NULL ,
`Points+` INT( 1 ) NOT NULL ,
`Stat2` VARCHAR( 15 ) NOT NULL ,
`Points-` INT( 1 ) NOT NULL ,
`Material1` VARCHAR( 15 ) NOT NULL ,
`Needed1` INT( 1 ) NOT NULL ,
`Material2` VARCHAR( 15 ) NOT NULL ,
`Needed2` INT( 1 ) NOT NULL ,
`Material3` VARCHAR( 15 ) NOT NULL ,
`Needed3` INT( 1 ) NOT NULL ,
`Material4` VARCHAR( 15 ) NOT NULL ,
`Needed4` INT( 1 ) NOT NULL ,
`Desc` TEXT NOT NULL
*/

//The ordering Part goes here.
   if(isset($_GET['act2']) && $_GET['act2'] != '')
   {
         $act2 = $_GET['act2'];

         if(isset($_GET['order']))
            $order = $_GET['order'];
         
         if(isset($_GET['by']) )       
            $by = $_GET['by'];

         if($by !='' && $order != '')
         {

            if($by == "price")
                 $ORDERBY = "ORDER BY Price";
            elseif($by =="slots")
                  $ORDERBY = "ORDER BY SlotsRequired";
            elseif($by =="rarity")
                  $ORDERBY = "ORDER BY Rarity";
            elseif($by =="skills")
                  $ORDERBY = "ORDER BY Stat1 ASC, `Points+` ";
            if($order == "down")
                  $ORDERBY .= " DESC";
            else
                  $ORDERBY .= " ASC";

         }     
   }


   $query .= $ORDERBY;
   //echo "<br>Query: $query<br>";
   $res = mysql_query($query) or die(mysql_error());
   

   ?>
<script type="text/javascript">
var hideJapFlag = false;
var hideUniteFlag = false;
var count = 0;

function hide2G()
{
   if(count >= 2){
      		location.reload(true);
      return;
   }
	if(!hideJapFlag)
	{
		hideJapFlag = true;
		var res = document.getElementsByName("2G");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="none";

	}

}

function show2G()
{
   if(count >= 2){
      		location.reload(true);
      return;
   }
	if(hideJapFlag)
	{
		hideJapFlag = false;
		var res = document.getElementsByName("2G");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="inline";
	}

}
function hideUnite()
{
   if(count >= 2){
      		location.reload(true);
            return;
   }
	if(!hideUniteFlag)
	{
		hideUniteFlag = true;
		var res = document.getElementsByName("unite");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="none";

	}

}
function showUnite()
{

   if(count >= 2){
      		location.reload(true);
      return;
   }
   if(hideUniteFlag)
   {
      hideUniteFlag = false;

		var res = document.getElementsByName("unite");
		var x = res.length;

		for(var i =0 ; i < x; i++)
			res[i].style.display="inline";


   }
}

</script>


<div align='left'>
<form id="ArmoryForm" name="ArmoryForm" action="./jewelry.php?act=search" method="get">
<style> .disabledstyle {color:#333333;} </style>
<table id="tableWeapons" cellpadding="0" cellspacing="0">
<tbody>
<tr><th class="heading" colspan="100">Decoration Search<sup>&beta;</sup></th></tr>

<tr>
   <td class="s_odd" style="padding: 0px 16px; text-align: left;" colspan="100">
   <div style="margin: 4px 0px;">Select a Skill: 
      <select name="skill">
            <?php printSkills() ?>
      </select>
      <input value="Search Now" name="searchDec" type="submit">&nbsp;&nbsp;<a href='./jewelry.php'>Reset</a>
   </div>
   </td>
</tr>

</tbody><tbody style="" id="simpleForm"><tr><td class="s_odd" style="padding: 0px 16px; text-align: left;" colspan="100">
<a style="font-size: 8pt; margin-left: 17px; cursor: pointer;" onclick="document.getElementById('simpleForm').style.display='none';document.getElementById('advancedForm').style.display='';">Advanced » </a></td></tr></tbody>

<tbody id="advancedForm" style="display: none;"><tr><td class="s_odd" style="padding: 0px 16px; text-align: left;" colspan="100">

<div style="margin: 4px 0px;"><span class="def">Used by</span> &nbsp;&nbsp;&nbsp;&nbsp;
<select name="wclass">
   <option value="Any">Any</option>
   <option value="Blademaster">Blademaster</option>
   <option value="Gunner">Gunner</option>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span class="def">Slots Required</span> 
<select name="slots" style="font-family: Courier New,Courier;">
   <option value="Any">Any</option>
   <option value="1">O</option>
   <option value="2">OO</option>
   <option value="3">OOO</option>
</select>
 &nbsp;

<span class="def">Rarity</span> <select name="rarity">
   <option value="Any">Any</option>
   <option value="4">4</option>
   <option value="5">5</option>
</select></div>

<div style="margin: 4px 0px;">

<span class="def">Material 1</span> &nbsp; 
   <select name="hasmat1">
<?php
   printMatOption()
?>
   </select> 
<br>
<span class="def">Material 2</span> &nbsp;
      <select name="hasmat2">
         <?php printMatOption() ?>
      </select>
<br>
<span class="def">Material 3</span> &nbsp;
      <select name="hasmat3">
         <?php printMatOption() ?>
      </select>
<br>
<span class="def">Material 4</span> &nbsp;
      <select name="hasmat4">
         <?php printMatOption() ?>
</select>

</div>

<a style="font-size: 8pt; margin-left: 17px; cursor: pointer; clear: both;" onclick="document.getElementById('advancedForm').style.display='none';document.getElementById('simpleForm').style.display='';"> « Simple 
</a></td></tr>
</tbody>

<tbody>
   <tr><td class="s_odd" style="padding: 0px 16px; text-align: left;" colspan="100">
      <div style="height: 4px;"></div></td></tr>
   <tr><td style="height: 4px;"><div></div></td></tr>
   </tbody>

</table>
<script>
x=document.getElementById('isskill').value; y=document.getElementById('altskill'); if (x==0||x==1||x==2) {y.className='disabledstyle';y.disabled=true;y.value=0;} else {y.className='';y.disabled=false;} 
</script>
</form>
</div>


<br>
<div align='center'>
<input type="radio" onClick="hide2G();showUnite();count++;" name='optionA' value="false">Hide 2ndG
<input type="radio" onClick="hideUnite();show2G();count++;" name='optionA' value="false">Hide Unite
</div>
<br>


<table id="tableWeapons" cellpadding="0" cellspacing="0">
<tbody><tr><th colspan="100" class="heading">Decorations</th></tr>
<tr>
   <th style='text-align:center;' class="mini">&nbsp;</th>
   <th style='text-align:left;' class="mini" name="unite">Unite Names</th>
   <th style='text-align:left;' class="mini" name="2G">2G Names</th>
   <th style='text-align:center;white-space:nowrap;' class="mini">
      <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=price&amp;order=up<?=$extra?>" title="Ascending Price Ordering">&uArr;</a></font>
            Price
      <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=price&amp;order=down<?=$extra?>" title="Descending Price Ordering">&dArr;</a></font>
   </th>
   <th style='text-align:center;white-space:nowrap;' class="mini">
      <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=slots&amp;order=up<?=$extra?>" title="Ascending Slot Ordering">&uArr;</a></font>
            Slots
      <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=slots&amp;order=down<?=$extra?>" title="Descending Slot Ordering">&dArr;</a></font>
   </th>
   <th style='text-align:center;white-space:nowrap;' class="mini">Hunter Type</th>
   <th class="mini">&nbsp;</th>
   <th style='text-align:center;width:100px;' class="mini" colspan=2>
       <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=skills&amp;order=up<?=$extra?>" title="Ascending Skill Ordering (Name and Skill Point)">&uArr;</a></font>      
         Skills
 <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=skills&amp;order=down<?=$extra?>" title="Descending Skill Ordering (Name and Skill Point)">&dArr;</a></font>
   </th>
   <th class="mini">&nbsp;</th>
   <th style='text-align:center' class="mini" colspan=2>Material</th>
   <th style='text-align:center' class="mini">Description</th>
   <th style='text-align:center;white-space:nowrap;' class="mini">
         <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=rarity&amp;order=up<?=$extra?>" title="Ascending Rarity Ordering">&uArr;</a></font>
            Rank
         <font style='font-size:20px'><a href="./jewelry.php?act2=org&amp;by=rarity&amp;order=down<?=$extra?>" title="Descending Rarity Ordering">&dArr;</a></font>
   </th>
</tr>
</tbody>

<?

   //Create array color
   $queryColor = "select * from skillcolor";
   $color_res = mysql_query($queryColor) or die(mysql_error());
   $colorJWL = array();
   while($ansCol = mysql_fetch_array($color_res))
   {
      $colorJWL[$ansCol['skill']] = $ansCol['color'];
   }

   $ctn="odd";
   while($ans = mysql_fetch_array($res)) 
   {
      echo "<tbody class='$ctn'>";
      echo "<tr>";
            echo "<td><img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'></td>";
            echo "<td class='mini' style='text-align:left;' name='unite'><b>".$ans['UniteNames']."</b></td>";
            echo "<td class='mini' style='text-align:left;' name='2G'><b>".$ans['2gNames']."</b></td>";
            echo "<td class='mini' style='text-align:center'>".$ans['Price']."z</td>";
            echo "<td class='mini' style='text-align:left;'>";
               
               $slot = $ans['SlotsRequired'];
               if($slot == 1)
                  //echo "O--";
                  echo "<img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>";
               elseif($slot == 2)
                  //echo "OO-";
                  echo "<img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>
                        <img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>";
               else
                  //echo "OOO";
                  echo "<img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>
                        <img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>
                        <img src='./jwlimg/".$colorJWL[$ans['Stat1']]."j.gif' align='bottom'>";
            echo "</td>";

            echo "<td class='mini' style='text-align:center'>".$ans['HunterType']."</td>";
            echo '<td class="mini">&nbsp;</td>';
            echo "<td class='mini' style='text-align:right;font-size:11px;'>".$ans['Stat1'];
                      if($ans['Points-'] != 0)
                           echo "<br>".$ans['Stat2']."</td>";
                      else
                           echo "</td>";

             echo "<td class='mini' style='text-align:left;width:30px;font-size:11px;'>:&nbsp;+".$ans['Points+'];
                      if($ans['Points-'] != 0)
                           echo "<br>:&nbsp;".$ans['Points-']."</td>";
                      else
                           echo "</td>";     

           echo '<td class="mini">&nbsp;</td>';
            echo "<td class='mini' style='font-size:10px;text-align:left;'>";
                        echo $ans['Material1'];
                        if($ans['Needed2'] != 0){
                           echo "<br>".$ans['Material2'];
                           if($ans['Needed3'] != 0){
                              echo "<br>".$ans['Material3'];
                              
                              if($ans['Needed4'] != 0)
                                 echo "<br>".$ans['Material4'];
                           }
                        }

            echo "</td><td class='mini' style='font-size:10px;text-align:left;'>";
                        echo ':'.$ans['Needed1'];
                        if($ans['Needed2'] != 0){
                           echo "<br>:".$ans['Needed2'];
                           if($ans['Needed3'] != 0){
                              echo "<br>:".$ans['Needed3'];
                              
                              if($ans['Needed4'] != 0)
                                 echo "<br>:".$ans['Needed4'];
                           }
                        }

            echo "</td>";
            echo "<td class='mini' style='font-size:11px;'>".$ans['Desc']."</td>";

            $rarity = $ans['Rarity'];
            echo "<td style='text-align:center' class='rare$rarity'>".$rarity."</td>";

      echo "</tr></tbody><tr style='height:1px'></tr>";

      if($ctn == "odd")
         $ctn= "even";
      else
         $ctn="odd";
   }
?>
</table>
<!--
<br><b>PWNED!!!</b>
This is ZackVixACD's work baby!!!
-->
<?php 

mysql_close();
include('include/soc_footer.inc.php'); ?>
