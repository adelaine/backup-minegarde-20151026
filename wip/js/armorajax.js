var xmlHttp;

var baseurl = 'http://minegarde.com/wip/';
var url=baseurl+"include/armorquery.inc.php";
var parameters = "armorName=" + escape(encodeURI(document.getElementById("armorName").value ));

function showArmors()
{
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

url=baseurl+"include/armorquery.inc.php";
parameters = "armorName=" + escape(encodeURI(document.getElementById("armorName").value ));

      xmlHttp.onreadystatechange = requestReady;
      xmlHttp.open('POST', url, true);
      xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttp.setRequestHeader("Content-length", parameters.length);
      xmlHttp.setRequestHeader("Connection", "close");
      xmlHttp.send(parameters);
}

function showArmors2()
{
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

url=baseurl+"include/advarmorquery.inc.php";
parameters='';

if (document.getElementById('advancedForm').style.display=='')
{
x=document.getElementsByTagName('input');
for(i=0;i<x.length;i++)
{
  if (i>0) parameters+='&';
	if (x[i].type=='checkbox')
	{
	  if (x[i].checked) 
      parameters+=x[i].name+'='+x[i].value;
	}
	else if (x[i].name!='armorName')
	{
    parameters+=x[i].name+'='+x[i].value;
	}
}
x=document.getElementsByTagName('select');
for(i=0;i<x.length;i++)
{
  parameters+='&'+x[i].name+'='+x[i].value;
}
  parameters+='&advSearch=1';

}
  parameters += "&armorName=" + escape(encodeURI(document.getElementById("armorName").value ));

      xmlHttp.onreadystatechange = requestReady;
      xmlHttp.open('POST', url, true);
      xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttp.setRequestHeader("Content-length", parameters.length);
      xmlHttp.setRequestHeader("Connection", "close");
      xmlHttp.send(parameters);
} 
 

function requestReady() 
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById("ArmoryForm").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}