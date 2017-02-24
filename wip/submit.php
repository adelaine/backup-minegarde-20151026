<?php include('include/soc_header.inc.php'); ?>
<script language="JavaScript" type="text/javascript">
<!--
function disableThis(x)
{
  if (x == 'Solo')
	{
	  document.getElementById('h1').style.display='none';
    document.getElementById('n1').disabled=true;	
    document.getElementById('n1').value='';	
    document.getElementById('n2').disabled=true;	
    document.getElementById('n2').value='';	
    document.getElementById('n3').disabled=true;	
    document.getElementById('n3').value='';	
	}
  else
	{
    document.getElementById('n1').disabled=false;	
    document.getElementById('n2').disabled=false;	
    document.getElementById('n3').disabled=false;	
	  document.getElementById('h1').style.display='';
	}
}
//-->
</script>
<h1>Registration</h1>
<a href="http://z4.invisionfree.com/mhph">Monster Hunter Philippines</a>
<br>Oct. 4, 2008 Tournament
<br>Sponsored by SM Cyberzone
<br><br>
<form action="FormToEmail.php" method="post">
<table border="0" cellspacing="5">
<tr><td>Event</td><td><select name="event" onChange="disableThis(this.value);" id='s1'>
<option value="Solo">Solo Tournament</option>
<option value="Pair">Pair Tournament</option>
</select>
</td></tr>
<tr><td>Participant</td><td><input type="text" size="30" name="name"></td></tr>
<tr><td>Email</td><td><input type="text" size="30" name="email"></td></tr>
<tr><td>Cellphone</td><td><input type="text" size="30" name="contactinfo"></td></tr>
<tbody id="h1">
<tr><td>Participant</td><td><input type="text" size="30" name="name2" id="n1"></td></tr>
<tr><td>Email</td><td><input type="text" size="30" name="email2" id="n2"></td></tr>
<tr><td>Cellphone</td><td><input type="text" size="30" name="contactinfo2" id="n3"></td></tr>
</tbody>
<tr><td valign="top">Comments</td><td><textarea name="comments" rows="6" cols="30"></textarea></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Send"><font face="arial" size="1">&nbsp;&nbsp;<a href="http://FormToEmail.com">Form Mail</a> by FormToEmail.com</font></td></tr>
</table>
</form>
<script language="JavaScript" type="text/javascript">
<!--
disableThis(document.getElementById('s1').value);
//-->
</script>

<?php include('include/soc_footer.inc.php'); ?>