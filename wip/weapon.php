<?php
error_reporting(0);
  include('include/soc_header.inc.php');
  if (!empty($_REQUEST['w']))
	switch ($_REQUEST['w'])
	{
	  case 'gs': case 'ls': $title="Great Swords / Long Swords"; $fname="GSTrans.csv"; $weapname='Great Swords'; $altweapname='Long Swords'; break;
	  case 'sns': case 'ds': $title="Sword and Shield / Dual Swords"; $fname="SnSTrans.csv"; $weapname='Sword and Shield'; $altweapname='Dual Swords'; break;
	  case 'hm': case 'hh': $title="Hammers / Hunting Horns"; $fname="HMTrans.csv"; $weapname='Hammers'; $altweapname='Hunting Horns'; break;
	  case 'lc': case 'gl': $title="Lances / Gunlances"; $fname="LCTrans.csv"; $weapname='Lances'; $altweapname='Gunlances'; break;
		case 'bw': $title="Bows"; $fname="BWTrans.csv"; $weapname="Bows"; $altweapname=""; break;
 		case 'lbg': case 'hbg' : $title="Light Bowgun / Heavy Bowgun"; $fname="LBTrans.csv"; $weapname='Light Bowgun'; 
			$altweapname='Heavy Bowgun';break;
		default : $title="Great Swords / Long Swords"; $fname="GSTrans.csv"; $weapname='Great Swords'; $altweapname='Long Swords'; break;
	}
  else
  {
	$title="Great Swords / Long Swords"; $fname="GSTrans.csv";
	$weapname='Great Swords'; $altweapname='Long Swords';
  }
	echo '<script type="text/javascript">';
	echo 'arrHeaders = new Array();';
	echo 'arrWeapons= new Array();';
	echo 'arrDuplicates = new Array();';
	echo '</script>';


define('BLOCKSIZE','1024');
$handle = fopen("dump/".$fname, "r");

if ($handle)
{
  //echo '<table id="tableWeapons" cellpadding="0" cellspacing="0">';
	echo '<script type="text/javascript">';
	/*echo 'arrHeaders = new Array(';
  $line = fgets($handle, BLOCKSIZE);
	$line = trim($line);
	$line = explode(',',$line);
	foreach ($line as $k => $q)
	{
	  if ($k > 0) echo ',';
	  echo '"'.$q.'"';
	}
	echo ');';*/

	echo 'arrWeapons= new Array();';
	$arrCnt = -1;
  while (!feof($handle))
  {
    $l = fgets($handle, BLOCKSIZE);
		$l = trim($l);
  	$l = explode(',',$l);

		//this is a weapon
		if (count($l)>=9 || (count($l)<5&&$l[2][0]=='('))
		{
		  $arrCnt++;
		  echo 'arrWeapons['.$arrCnt.']=new Array(); arrWeapons['.$arrCnt.']["Info"]=new Array(';
	    foreach ($l as $k => $q)
    	{
			  if ($k > 0) echo ', ';
    	    echo '\''.addslashes($q).'\'';
	    }
    	echo ');';
			if (count($l)<5 && $l[2][0]=='(')
			{
			  echo 'arrDuplicates["'.$l[3].'"] = '.$arrCnt.';';
			  echo 'arrDuplicates["'.$arrCnt.'"] = '.$l[3].';';
			}
		}
		else
		{
       if (count($l) > 1)
		    echo 'arrWeapons['.$arrCnt.']["'.$l[0].'"]="'.$l[1].'";';
		}

		/*
		if (count($l)==9 || (count($l)==3&&$l[2][0]=='('))
		{
      echo '<tr>';
  		echo '<td>';
  		for($i=0;$i<strlen($l[0]);$i++)
	  	{
		    switch($l[0][$i])
				{
				  case 'L' : echo '<div class="dn">&nbsp</div>';
					  break;
					case 'R' : echo '<div class="rt1">&nbsp</div><div class="rt2">&nbsp</div>';
					  break;
					case 'E' : echo '<div class="en">&nbsp</div>';
					  break;
					default : echo '<div class="sp">&nbsp</div>';
					  break;
				}//end switch
  		}//end for
	  	echo '<div class="cn">'.$l[1];
			if (count($l)<9)
			  echo '<span class="mini">&nbsp'.$l[2].'</span>';
		  echo '</div></td>';
			if (count($l)==9)
			{
			  echo '<td>'.$l[2].'</td>';
			  echo '<td>'.$l[3].'</td>';
			  echo '<td>'.$l[4].'</td>';
				$l[5]=explode(' ',$l[5]);
			  echo '<td>'.$l[5][0].'<br>'.$l[5][1].'</td>';
			  echo '<td>'.$l[6].'</td>';
			  echo '<td>'.$l[7].'</td>';
			  echo '<td>'.$l[8].'</td>';
			}
    	echo '</tr>';
		}//*/
  }
  //echo '</table>';
	fclose($handle);

  $lines = file("dump/path".$fname);

	if (!empty($lines))
	{
	echo 'GWeap='.trim($lines[0]).';';
	echo 'altGWeap='.trim($lines[1]).';';
	$lines = explode(',',$lines[2]);
	if (count($lines) > 0)
	{
	  echo 'subpaths= new Array(';
		foreach ($lines as $k => $l)
		{
		  if ($k>0) echo ',';
			echo $l;
		}
		echo ');';
	}
	}
	else
	{
	  echo 'GWeap=-1; altGWeap=-1; subpaths=new Array();';
	}
	echo 'weapname="'.$weapname.'";';
	echo 'altweapname="'.$altweapname.'";';


	echo '</script>';
}
else
{
	echo "Couldn't open file.";
}

?>
<center>
<h1>Monster Hunter Portable 2nd G</h1>
<h1><?php echo $title; ?></h1>
<div style="position:relative;top:-10px;color:hotpink;background:#070002;padding:4px;width:600px">
Click on a row to expand it. Best viewed in IE7 or <b><span style="color:thistle">Firefox3</span></b>.
</div>
<input type="checkbox" id="expandButton" onChange="expandAll(arrWeapons, this.checked)" name="expand" value="1" />Expand All
<script> document.getElementById('expandButton').checked=false; </script>
<div id="divContents">
<noscript>
Please enable Javascript in your browser.
</noscript>
</div>
</div>
</center>
<script>
// credit for this function goes to aegilnet of http://www.aegil.net/
(function(i)
{
    var u = navigator.userAgent;
    var e=/*@cc_on!@*/false;
    var st = setTimeout;
    if(/webkit/i.test(u))
    {
        st(function()
        {
            var dr=document.readyState;
            if(dr=="loaded"||dr=="complete")
            {
                i()
            }
            else
            {
                st(arguments.callee,10);
            }
        },10);
    }
    else if((/mozilla/i.test(u)&&!/(compati)/.test(u)) || (/opera/i.test(u)))
    {
        document.addEventListener("DOMContentLoaded",i,false);
    }
    else if(e)
    {
        (function()
        {
            var t=document.createElement('doc:rdy');
            try
            {
                t.doScroll('left');
                i();
                t=null;
            }
            catch(e)
            {
                st(arguments.callee,0);
            }
        })();
    }
    else
    {
        window.onload=i;
    }
})(generateTree(arrWeapons));
</script>
<?php include('include/soc_footer.inc.php'); ?>
