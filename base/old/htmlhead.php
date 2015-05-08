<?php
$prependBasePath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="'.$prependBasePath.'/css/css.php" />
	'./*<link rel="stylesheet" type="text/css" href="'.$prependBasePath.'/js/shadowbox/shadowbox.css" />*/
	'<link rel="icon" type="image/png" href="'.$prependCSSPath.'/favicon.png" />
	<title>';
if(isset($pageTitle)){echo $pageTitle." | ";}
$headContent .= 'Liberty High School Robotics FIRST Team 1764</title>
	<link rel="alternate" type="application/rss+xml"  href="'.$prependBasePath.'/rss/" title="Liberty High School Robotics Events Feed" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<script type="text/javascript" src="'.$prependBasePath.'/js/jquery-1.4.4.min.js"></script>
	'.//<script type="text/javascript" src="'.$prependBasePath.'/js/hoverIntent.js"></script>
	//<script type="text/javascript" src="'.$prependBasePath.'/js/superfish.js"></script>
	//<script type="text/javascript" src="'.$prependBasePath.'/js/supersubs.js"></script>
	//<script type="text/javascript" src="'.$prependBasePath.'/js/shadowbox/shadowbox.js"></script>
	'<script type="text/javascript" src="'.$prependBasePath.'/js/jscombo.js"></script>
	<script type="text/javascript" src="'.$prependBasePath.'/js/jFontSizer.php"></script>
	<script type="text/javascript" src="'.$prependBasePath.'/js/jscroller-0.4.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("ul.sf-menu").supersubs({
				minWidth: 6,
				maxWidth: 80,
				extraWidth: 0.5
			}).superfish({ 
				pathClass:  "current",
				delay: "600",
				speed: "fast"
			});
			$(\'#fontsizer\').jfontsizer({
				applyTo: \'div#resize-content\',
				changefactor: 0.12,
				expire: 3
			});
                        $(\'a.ajaxlink\').bind(\'click\', function(event) {
                            event.preventDefault();
                            $.get(this.href,{}, function(response) {
                                   responseFunction(response,event);
                                });
                            });
                        $(\'a.ajaxlinkjson\').bind(\'click\', function(event) {
                            event.preventDefault();
                            $.get(this.href,{}, function(response) {
                                   responseFunction(response,event);
                                },\'json\');
                            });

		});
		Shadowbox.init({
			counterType: "skip",
			initialHeight:0,
			initialWidth:0
		});
		$("")
	</script>';
if(isset($customScripts)){$headContent .= $customScripts;}
$headContent .= '
</head>
<body>
<div id="doc2" class="yui-t2">';
echo $headContent;
?>