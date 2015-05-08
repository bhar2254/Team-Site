<?php
$prependBasePath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependHTTPPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":"http://robotics-staging/");
echo '			</div>
		</div>'/* end #resize-content */.'</div>'/* end #main-content */.'
	</div>
	<div id="ft" class="yui-gb">
		<div class="yui-u first left">&nbsp;
		</div>
		<div class="yui-u center">
		<p>
		Liberty Robotics<br/>FIRST<sup>&reg;</sup> Team 1764<br/>Liberty Senior High School,<br/>Liberty Public Schools<br/>Liberty, Missouri<br/>200 Blue Jay Drive
		</p>
		</div>
		<div class="yui-u right">
		<p>
		<a href="'.$prependBasePath.'/rss/"><img src="'.$prependBasePath.'/images/feed-icon.png" alt="Liberty Robotics Team RSS Feed" title="Liberty Robotics Team RSS Feed"/></a>
		</p>
		</div>
	</div>
</div>
</body>
</html>';
?>