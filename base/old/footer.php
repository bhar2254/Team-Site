<?php
//This is a test of the comment area.

$prependBasePath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependHTTPPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":"http://robotics-staging/");
echo '			</div>
		</div>'/* end #resize-content */.'</div>'/* end #main-content */.'
		<div class="yui-b" id="sidebar-content">
		<form name="search" method="get" action="'.$prependHTTPPath.'/search/">
			<div id="searchBox">
				<input type="text" name="q" value="'.($googleQueryText==null?null:$googleQueryText).'"/>
				<input type="submit" id="searchButton" value=""/>
			</div>
		</form>
		<a href="'.$prependHTTPPath.'"><img src="'.$prependBasePath.'/images/sponsors/libertyroboticslogo.png" alt="Liberty Robotics" title="Liberty Robotics"/></a>
		<a target="_blank" href="http://www.usfirst.org"><img src="'.$prependBasePath.'/images/sponsors/firstlogo.png" alt="FIRST&reg; Robotics" title="FIRST&reg; Robotics"/></a>
		<br/>
		<br/>
			<div>';
		writeTitle("Sponsors",3); // Sponsor Sidebar content
		echo '(mouse over to pause)</div>
		<br/>
<script type="text/javascript">
 $(document).ready(function(){

  // Add Scroller Object
  $jScroller.add("#box1_container","#box1_content","up",3,true);
  // Start Autoscroller
  $jScroller.start();
 });
</script>

<div id="box1_container" class="scroller_container_up_down">
 <div id="box1_content" class="scroller_up_down">
		<!--<marquee behavior="scroll" direction="up" height="400" width="100%" scrollamount="5" onmouseover="this.stop();" onmouseout="this.start();" style="text-align: center;">-->
		<br/>
		<br/>
			<div class="sponsorsdivision" id="foundingsponsors"><h4>Diamond Founding Sponsor</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.kauffman.org"><img src="'.$prependBasePath.'/images/sponsors/emkf.png" alt="Ewing Marion Kauffman Foundation" title="Ewing Marion Kauffman Foundation"/></a>
				<br/><br/>
			</div>
			<div class="sponsorsdivision" id="diamondsponsors"><h4>Diamond</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.liberty.k12.mo.us/"><img src="'.$prependBasePath.'/images/sponsors/lps.png" alt="Liberty Public Schools" title="Liberty Public Schools"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://libertyroboticsfoundation.org/"><img src="'.$prependBasePath.'/images/sponsors/libertyroboticsfoundation.png" alt="Liberty Robotics Foundation" title="Liberty Robotics Foundation"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.pridemfgkc.com/"><img src="'.$prependBasePath.'/images/sponsors/pride.png" alt="Pride Manufacturing" title="Pride Manufacturing"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.kcpl.com/"><img src="'.$prependBasePath.'/images/sponsors/kcpl.png" alt="KCP&amp;L" title="KCP&amp;L"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.argusconsulting.com/"><img src="'.$prependBasePath.'/images/sponsors/argus.png" alt="Argus" title="Argus"/></a>
				<br/><br/>
				
				<br/><br/>
			</div>
			<div class="sponsorsdivision" id="platinumsponsors"><h4>Platinum</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.lindsaymachineworks.com/"><img src="'.$prependBasePath.'/images/sponsors/lindsay.png" alt="Lindsay Machine Works" title="Linday Machine Works"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://kansascity.lairdplastics.com/index.php?option=content&amp;task=section&amp;id=20&amp;Itemid=67&amp;MCU=7"><img src="'.$prependBasePath.'/images/sponsors/laird.png" alt="Laird Plastics" title="Laird Plastics"/></a>
				<br/><br/>
                                <a target="_blank" href="http://www.honeywell.com/"><img src="'.$prependBasePath.'/images/sponsors/honeywell.png" alt="Honeywell" title="Honeywell"/></a>
                                <br/><br/>
			</div>
			<div class="sponsorsdivision" id="goldsponsors"><h4>Gold</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.garycrossleyford.com/"><img src="'.$prependBasePath.'/images/sponsors/crossley.png" alt="Gary Crossley Ford" title="Gary Crossley Ford"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://driveone4urschool.com/"><img src="'.$prependBasePath.'/images/sponsors/drive_one.png" alt="Drive One 4ur School" title="Drive One 4ur School"/></a>
				<br/><br/>
                                <a target="_blank" class="sponsor" href="http://www.timewarnercable.com/"><img src="'.$prependBasePath.'/images/sponsors/time_warner_cable.png" alt="Time Warner Cable" title="Time Warner Cable"/></a>
                                <br/><br/>
			</div>
			<div class="sponsorsdivision" id="silversponsors"><h4>Silver</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.proactgroup.com/"><img src="'.$prependBasePath.'/images/sponsors/proact.png" alt="Pro-Act Marketing Group" title="Pro-Act Marketing Group"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.greensaversusa.com/"><img src="'.$prependBasePath.'/images/sponsors/greensavers.png" alt="GreenSavers" title="GreenSavers"/></a>
				<br/><br/>
                                <a target="_blank" class="sponsor" href="http://www.northsafety.com/"><img src="'.$prependBasePath.'/images/sponsors/north.png" alt="North Safety" title="North Safety"/></a>
				<br/><br/>
			</div>
			<div class="sponsorsdivision" id="bronzesponsors"><h4>Bronze</h4><br/>
				<a target="_blank" class="sponsor" href="http://www.lamars.com/"><img src="'.$prependBasePath.'/images/sponsors/lamars.png" alt="Lamar\'s Donuts" title="Lamar\'s Donuts"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.rotary.org/"><img src="'.$prependBasePath.'/images/sponsors/rotary.png" alt="Rotary Club" title="Rotary Club"/></a>
				<br/><br/>
				<a target="_blank" class="sponsor" href="http://www.banklibertykc.com/"><img src="'.$prependBasePath.'/images/sponsors/bankliberty.png" alt="BankLiberty" title="BankLiberty"/></a>
				<br/><br/>

			</div><!--</marquee>--></div></div>
		'.
		//<a target="_blank" href="http://www.northsafety.com/"><img src="'.$prependBasePath.'/images/sponsors/north.png" alt="Northstar Safety" title="Northstar Safety"/></a>
		//<br/><br/>
		'</div>
	</div>

	<div id="ft" class="yui-gb">
		<div class="yui-u first left"><a href="'.$prependBasePath.'/rss/"><img src="'.$prependBasePath.'/images/feed-icon.png" alt="Liberty Robotics Team RSS Feed" title="Liberty Robotics Team RSS Feed"/></a>
		</div>
		<div class="yui-u center">
		<p>
		Liberty Robotics<br/>FIRST<sup>&reg;</sup> Team 1764<br/>Liberty Senior High School,<br/>Liberty Public Schools<br/>Liberty, Missouri<br/>200 Blue Jay Drive
		</p>
		</div>
		<div class="yui-u right">
		<p>
		<a href="#top"><strong>Top of Page</strong></a>
		</p>
		</div>
	</div>
</div>';
if($_SERVER['HTTP_HOST'] == "www.liberty.k12.mo.us" || $_SERVER['HTTP_HOST'] == "www")
{
echo '
		<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.liberty.k12.mo.us/piwik/" : "http://www.liberty.k12.mo.us/piwik/");
document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.liberty.k12.mo.us/piwik/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>';
}
echo '
</body>
</html>';
?>
