<?php
$prependBasePath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);

echo '	<div id="hd">
		<div id="logo"><a href="'.($prependCSSPath==null?"/":$prependCSSPath).'"><img src="'.$prependBasePath.'/images/teamlogoheader.png" alt="Liberty Robotics, Team 1764" title="Liberty Robotics, Team 1764"/></a></div>';
$pageReference = str_replace("/","-",str_replace("/hs/libertyrobotics", "", $_SERVER["REQUEST_URI"]));
$pageReference = ($pageReference=="-"?"home":$pageReference);
$pageId = ($pageId==null?trim($pageReference,"-"):$pageId);
echo '</div>
<div id="bd">
		<div id="yui-main">
			<div class="yui-b" id="main-content"><div id="resize-content">';
?>