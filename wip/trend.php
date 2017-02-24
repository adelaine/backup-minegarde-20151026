<?php
  include('include/soc_header.inc.php');
?>
<center>
<h1>Alexa Graph</h1>
<!-- Alexa Graph Widget from http://www.alexa.com/site/site_stats/signup -->
	
<script type="text/javascript" 
	src="http://widgets.alexa.com/traffic/javascript/graph.js"></script>
	
<script type="text/javascript">/*
<![CDATA[*/

   // USER-EDITABLE VARIABLES
   // enter up to 3 domains, separated by a space
   var sites      = ['reign-of-the-rathalos.com skiesofcroda.com theendoftimes.net']; 
   var opts = {
      width:      380,  // width in pixels (max 400)
      height:     300,  // height in pixels (max 300)
      type:       'r',  // "r" Reach, "n" Rank, "p" Page Views 
      range:      '3m', // "7d", "1m", "3m", "6m", "1y", "3y", "5y", "max" 
      bgcolor:    'e6f3fc' // hex value without "#" char (usually "e6f3fc")
   };
   // END USER-EDITABLE VARIABLES	
   AGraphManager.add( new AGraph(sites, opts) );
	
//]]></script>
	
<!-- end Alexa Graph Widget -->
</div>
</center>
</div>
<?php include('include/soc_footer.inc.php'); ?>