<?php
  include('include/soc_header.inc.php');

  if (!empty($_REQUEST['user']))
   $chatuser = $_REQUEST['user'];
  else
   $chatuser = 'crodabish_%3F%3F%3F%3F';

?>
<center>
<div style="width:600px;padding:20px;text-align:left;">
<span style="color:lemonchiffon;">Welcome to the Skies of Croda chat.</span><br>
To change your nick, type in <span style="color:#44709d;">/nick [YourName]</span>.<br>
If you are a channel operator, or have a registered nick, please type in <span style="color:#44709d;white-space:nowrap;">/msg NickServe IDENTIFY [YourPassword]</span>.
</div>
<iframe width="750" height="470" scrolling=no style="border:0" frameborder="0" src="http://embed.mibbit.com/?server=irc.mibbit.com&channel=%23socb&settings=50a6308d2faa965790c51eedb321f9c5&nick=<?php echo $chatuser; ?>&needSendButton=true&forcePrompt=false&promptPass=true"></iframe>
<div style="width:600px;">
This IRC Chat Widget is provided by <a href="http://mibbit.com/">Mibbit</a>.
</div>
</center>
<?php
  include('include/soc_footer.inc.php');
?>
