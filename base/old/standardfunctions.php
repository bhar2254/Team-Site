<?php
$prependPath = ($_SERVER["HTTP_HOST"]=="robotics-staging"?"/var/www/robotics":"/var/www/hs/libertyrobotics");
$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
$prependHTTPPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics/":"/");


function writeTitle($title,$level){
	echo "<h".$level." class=\"title".$level."\">".$title."</h".$level.">";
}


function findFiles($path, $exclude = ".|..", $recursive = false){
		$path = rtrim($path, "/") . "/";
		$folder_handle = opendir($path);
		$exclude_array = explode("|", $exclude);
		$result = array();
		while(false !== ($filename = readdir($folder_handle))) {
			if(!in_array(strtolower($filename), $exclude_array)) {
				if(is_dir($path . $filename . "/")) {
					if($recursive) $result[] = file_array($path, $exclude, true);
				}else{
					$result[] = $path.$filename;
				}
			}
		}
	return $result;
}


function getThumb($filePath,$fileName,$fileExtension,$galleryName){
	if(!file_exists($filePath."/tn/".$fileName.".".$fileExtension)){
		$image = new Imagick();
		$image->readImage($filePath."/".$fileName.".".$fileExtension);
		$image->resizeImage(160,160,Imagick::FILTER_LANCZOS,1,true);
		$image->writeImage($filePath."/tn/".$fileName.".".$fileExtension);
		$image->clear();
		$image->destroy();
	}
	return '						<a href="'.$filePath."/".$fileName.".".$fileExtension.'" rel="shadowbox['.$galleryName.']"><img src="'.$filePath."/tn/".$fileName.".".$fileExtension.'" alt="" title="" class="galleryImage"/></a><br/><br/>'."\r\n";
}


function makeGallery($files, $galleryName, $page){
	$prependHTTPPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics/":"/");
	echo "<br/>\r\n";
	if($_GET["p"]==null){
		$page=0;
	}else{
		$page=$_GET["p"];
	}
	$counter=0;
	$perpage=30;
	if(count($files)>30){
		echo '				<div class="yui-gb galleryrow">'."\r\n";
		echo '					<div class="yui-u first">';
		if(($page*$perpage)!=0){
			echo '<a id="previouspagebutton" href="?p='.($page-1).'">&lt;&lt; Previous Page</a><br/><a id="firstpagebutton" href="?p='.(0).'">&lt;&lt; First Page</a>';
		}else{
			echo '&nbsp;';
		}
		echo '<br/></div>'."\r\n";
		echo '					<div class="yui-u"><a href="'.$prependHTTPPath.'media/galleries/">Back to Galleries</a><br/>Page '.($page+1).' of '.((1+(count($files)-(count($files)%30))/30)).'<br/><br/></div>'."\r\n";
		if(count($files)-(($page+1)*$perpage)>0){
			echo '<a id="nextpagebutton" href="?p='.($page+1).'">Next Page &gt;&gt;</a><br/><a id="lastpagebutton" href="?p='.(((count($files)-(count($files)%30))/30)).'">Last Page &gt;&gt;</a>';
		}else{
			echo '&nbsp;';
		}
		echo '				</div>'."\r\n";
	}else{
		echo '				<div class="yui-gb galleryrow">'."\r\n";
		echo '					<div class="yui-u first">';
			echo '&nbsp;';
		echo '<br/></div>'."\r\n";
		echo '					<div class="yui-u"><a href="'.$prependHTTPPath.'media/galleries/">List of Galleries</a><br/>Page '.($page+1).' of '.((1+(count($files)-(count($files)%30))/30)).'<br/><br/></div>'."\r\n";
			echo '&nbsp;';
		echo '				</div>'."\r\n";
	}
	for($fileNumber=($page*$perpage); $fileNumber<(($page*$perpage)+min((count($files)+(3-count($files)%3)),$perpage)); $fileNumber++){
		if($counter==0){
			echo '				<div class="yui-gb galleryrow">'."\r\n";
			$counter++;
		}
		if($counter==1){
			echo '					<div class="yui-u first">'."\r\n";
		}
		if($counter==2||$counter==3){
			echo '					<div class="yui-u">'."\r\n";
		}
		if($fileNumber>=count($files)){
			echo "						&nbsp;\r\n";
		}else{
			$fileInfo = explode(".",$files[$fileNumber]);
			$fileInfoWithoutExtension = explode("/",$fileInfo[0]);
			$fileExtension = $fileInfo[count($fileInfo)-1];
			$fileName = $fileInfoWithoutExtension[count($fileInfoWithoutExtension)-1];
			array_pop($fileInfoWithoutExtension);
			$filePathComplete = implode("/",$fileInfoWithoutExtension);
			if($fileExtension=="jpg"||$fileExtension=="JPG"||$fileExtension=="gif"||$fileExtension=="png"){
				echo getThumb($filePathComplete,$fileName,$fileExtension,$galleryName);
			}
		}
		echo '					</div>'."\r\n";
		$counter++;
		if($counter==4){
			echo '				</div>'."\r\n";
			$counter=0;
		}
	}
	if(count($files)>30){
		echo '				<div class="yui-gb galleryrow">'."\r\n";
		echo '					<div class="yui-u first">';
		if(($page*$perpage)!=0){
			echo '<a href="?p='.($page-1).'">&lt;&lt; Previous Page</a>';
		}else{
			echo '&nbsp;';
		}
		echo '<br/></div>'."\r\n";
		echo '					<div class="yui-u">&nbsp;<br/><br/></div>'."\r\n";
		if(count($files)-(($page+1)*$perpage)>0){
			echo '<a href="?p='.($page+1).'">Next Page &gt;&gt;</a>';
		}else{
			echo '&nbsp;';
		}
		echo '				</div>'."\r\n";
	}
}


function homeSlides($files){
        sort($files);//Added to make my image be the first one based on file name.
	$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
	$script = "\r\n	".'<script type="text/javascript">
	//<![CDATA[
	$(window).load(function(){';
	$counter=0;
		for($fileNumber=0; $fileNumber<(count($files)); $fileNumber++){
			$fileInfo = explode(".",$files[$fileNumber]);
			$fileInfoWithoutExtension = explode("/",$fileInfo[0]);
			$fileExtension = $fileInfo[count($fileInfo)-1];
			$fileName = $fileInfoWithoutExtension[count($fileInfoWithoutExtension)-1];
			array_pop($fileInfoWithoutExtension);
			$filePathComplete = implode("/",$fileInfoWithoutExtension);
                        if(!empty($fileName))
                        {
			if($fileExtension=="jpg"||$fileExtension=="JPG"||$fileExtension=="gif"||$fileExtension=="png"){
				$script .= "\n	".'$("#fade'.($counter+1).'").after(\'<a id="fade'.($counter+2).'"><img src="'.$prependCSSPath.'/images/slideshow/'.$fileName.".".$fileExtension.'" alt="" title=""/><\/a>\');';
			$counter++;
			}
                        }
		}
	$script .= "\n	".'$("#slideshow").cycle({
				fx:    \'fade\', 
				delay: -2000,
				speed:  1000,
				timeout:6000
		});
	});
	//]]>
	'."	".'</script>';
	return $script;
}


function ctslides($files){
	$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
        $prependCSSPath = "";
	$script = "\r\n	".'<script type="text/javascript">
	//<![CDATA[
	$(window).load(function(){';
	$counter=0;
		for($fileNumber=0; $fileNumber<(count($files)); $fileNumber++){
			$fileInfo = explode(".",$files[$fileNumber]);
			$fileInfoWithoutExtension = explode("/",$fileInfo[0]);
			$fileExtension = $fileInfo[count($fileInfo)-1];
			$fileName = $fileInfoWithoutExtension[count($fileInfoWithoutExtension)-1];
			array_pop($fileInfoWithoutExtension);
			$filePathComplete = implode("/",$fileInfoWithoutExtension);
			if($fileExtension=="jpg"||$fileExtension=="JPG"||$fileExtension=="gif"||$fileExtension=="png"){
				$script .= "\n	".'$("#fade'.($counter+1).'").after(\'<a id="fade'.($counter+2).'"><img src="'.$prependCSSPath.'img/ctslides/'.$fileName.".".$fileExtension.'" alt="" title=""/><\/a>\');';
			$counter++;
			}	
		}
	$script .= "\n	".'$("#slideshow-ct").cycle({
				fx:    \'fade\', 
				delay: -2000,
				speed:  1000,
				timeout:6000
		});
	});
	//]]>
	'."	".'</script>';
	return $script;
}


function kcslides($files){
	$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
        $prependCSSPath = "";
	$script = "\r\n	".'<script type="text/javascript">
	//<![CDATA[
	$(window).load(function(){';
	$counter=0;
	//var_dump($files);
		for($fileNumber=0; $fileNumber<(count($files)); $fileNumber++){
			$fileInfo = explode(".",$files[$fileNumber]);
			$fileInfoWithoutExtension = explode("/",$fileInfo[0]);
			$fileExtension = $fileInfo[count($fileInfo)-1];
			$fileName = $fileInfoWithoutExtension[count($fileInfoWithoutExtension)-1];
			array_pop($fileInfoWithoutExtension);
			$filePathComplete = implode("/",$fileInfoWithoutExtension);
			if($fileExtension=="jpg"||$fileExtension=="JPG"||$fileExtension=="gif"||$fileExtension=="png"){
				$script .= "\n	".'$("#kc-fade'.($counter+1).'").after(\'<a id="kc-fade'.($counter+2).'"><img src="'.$prependCSSPath.'img/kcslides/'.$fileName.".".$fileExtension.'" alt="" title=""/><\/a>\');';
			$counter++;
			}	
		}
	$script .= "\n	".'$("#slideshow-kc").cycle({
				fx:    \'fade\', 
				delay: -2000,
				speed:  1000,
				timeout:6000
		});
	});
	//]]>
	'."	".'</script>';
	return $script;
}


function mnslides($files){
	$prependCSSPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
        $prependCSSPath = "";
	$script = "\r\n	".'<script type="text/javascript">
	//<![CDATA[
	$(window).load(function(){';
	$counter=0;
	//var_dump($files);
		for($fileNumber=0; $fileNumber<(count($files)); $fileNumber++){
			$fileInfo = explode(".",$files[$fileNumber]);
			$fileInfoWithoutExtension = explode("/",$fileInfo[0]);
			$fileExtension = $fileInfo[count($fileInfo)-1];
			$fileName = $fileInfoWithoutExtension[count($fileInfoWithoutExtension)-1];
			array_pop($fileInfoWithoutExtension);
			$filePathComplete = implode("/",$fileInfoWithoutExtension);
			if($fileExtension=="jpg"||$fileExtension=="JPG"||$fileExtension=="gif"||$fileExtension=="png"){
				$script .= "\n	".'$("#mn-fade'.($counter+1).'").after(\'<a id="mn-fade'.($counter+2).'"><img src="'.$prependCSSPath.'img/mnslides/'.$fileName.".".$fileExtension.'" alt="" title=""/><\/a>\');';
			$counter++;
			}	
		}
	$script .= "\n	".'$("#slideshow-mn").cycle({
				fx:    \'fade\', 
				delay: -2000,
				speed:  1000,
				timeout:6000
		});
	});
	//]]>
	'."	".'</script>';
	return $script;
}


function cadalog_generate($arrayOfFiles, $fileFolder){
	$counter=0;
	$prependHTTPPath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics/":"/");
	echo '				<div class="yui-gb galleryrow">'."\r\n";
	echo '					<div class="yui-u first">';
	echo '&nbsp;';
	echo '<br/></div>'."\r\n";
	echo '					<div class="yui-u"><a href="'.$prependHTTPPath.'resources/cadalog/">Main Cadalog</a><br/><br/></div>'."\r\n";
	echo '&nbsp;';
	echo '				</div>'."\r\n";
	for($fileNumber=0; $fileNumber<(count($arrayOfFiles)+(3-((count($arrayOfFiles))%3))); $fileNumber++){
		if($counter==0){
			echo '				<div class="yui-gb galleryrow">'."\r\n";
			$counter++;
		}
		if($counter==1){
			echo '					<div class="yui-u first">'."\r\n";
		}
		if($counter==2||$counter==3){
			echo '					<div class="yui-u">'."\r\n";
		}
		if($fileNumber>=count($arrayOfFiles)){
			echo "						&nbsp;\r\n";
		}else{
			echo '<a href="'.$prependHTTPPath.$fileFolder."img/".$arrayOfFiles[$fileNumber].".jpg".'" rel="shadowbox[cadalog]" title="'.$arrayOfFiles[$fileNumber].'"><img src="'.$prependHTTPPath.$fileFolder."img/tn/".$arrayOfFiles[$fileNumber].".jpg".'" alt="" title=""/></a><br/><a href="'.$prependHTTPPath.$fileFolder."zips/".$arrayOfFiles[$fileNumber].".zip".'">'.$arrayOfFiles[$fileNumber].".zip".'</a><br/>'."\r\n"; //$arrayOfFiles[$fileNumber];
		}
		echo '					</div>'."\r\n";
		$counter++;
		if($counter==4){
			echo '				</div>'."\r\n";
			$counter=0;
		}
	}
}


function textSizer(){
	echo '<div id="fontsizer"></div>';
}


?>