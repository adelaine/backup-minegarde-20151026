<?php
  include('include/soc_header.inc.php'); 
	define ('INCLUDED','1');
	  $armfunc = 'showArmors2()';
?>
<style>#tableWeapons td {text-align:center;margin-bottom:1px;padding:4px;}</style>
<script type="text/javascript" src="js/armorajax.js"></script>
<center>
<h1>Armors</h1>
<form id="ArmoryForm" name="ArmoryForm" action="javascript:get(document.getElementById('ArmoryForm'));" onSubmit='<?php echo $armfunc; ?>;'>
<?php 	
  include('include/advarmorquery.inc.php'); 
?>
</form>
</center>
<?php  include('include/soc_footer.inc.php'); ?>