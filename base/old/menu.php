<?php
$prependBasePath = ($_SERVER["HTTP_HOST"]!="robotics-staging"?"/hs/libertyrobotics":null);
// Currently, this menu script supports one main level of navigation and a secondary submenu level, but NOT a tertiary level... yet
$menuarray = //This is the menu array that will be outputted $array = array("Fruit", "Vegetables", "Stuff"); echo $array[0]; 
array(
	array("title" => "Home", "link" => $prependBasePath."/", "pageid" => "home", "content" => ""),
	array("title" => "Our Team", "link" => $prependBasePath."/ourteam/", "pageid" => "ourteam", "content" =>
		array(
			array("title" => "Mission and Values", "link" => $prependBasePath."/ourteam/missionandvalues/", "pageid" => "ourteam-missionandvalues", "content" => ""),
			array("title" => "Membership", "link" => $prependBasePath."/ourteam/membership/", "pageid" => "ourteam-membership", "content" => ""),
			array("title" => "List of Members", "link" => $prependBasePath."/ourteam/list/", "pageid" => "ourteam-list", "content" => ""),
			array("title" => "Team History", "link" => $prependBasePath."/ourteam/teamhistory/", "pageid" => "ourteam-teamhistory", "content" => ""),
			array("title" => "Team Structure", "link" => $prependBasePath."/ourteam/teamstructure/", "pageid" => "ourteam-teamstructure", "content" => "")
		)
	),
	array("title" => "Calendar", "link" => $prependBasePath."/calendar/", "pageid" => "calendar", "content" => ""),
	array("title" => "Competitions", "link" => $prependBasePath."/competitions/", "pageid" => "competitions", "content" => ""/*
		array(
			array("title" => "Kansas City Regional", "link" => $prependBasePath."/competitions/", "pageid" => "", "content" => ""),
			array("title" => "Minnesota Regional", "link" => $prependBasePath."/competitions/", "pageid" => "", "content" => ""),
			array("title" => "St. Louis Championship", "link" => $prependBasePath."/competitions/", "pageid" => "", "content" => "")
		)
	*/),
	array("title" => "Media", "link" => $prependBasePath."/media/", "pageid" => "media", "content" =>
		array(
			array("title" => "News", "link" => $prependBasePath."/media/news/", "pageid" => "media-news", "content" => ""),
			array("title" => "Galleries", "link" => $prependBasePath."/media/galleries/", "pageid" => "media-galleries", "content" => ""),
			//array("title" => "Videos", "link" => $prependBasePath."/media/videos/", "pageid" => "media-videos", "content" => ""),
			array("title" => "Presentations", "link" => $prependBasePath."/media/presentations/", "pageid" => "media-presentations", "content" => ""),
			array("title" => "Massive Mini", "link" => $prependBasePath."/media/massivemini/", "pageid" => "media-massivemini", "content" => "")
		)
	),
	array("title" => "Sponsorship", "link" => $prependBasePath."/sponsorship/", "pageid" => "sponsorship", "content" =>
		array(
			array("title" => "Info", "link" => $prependBasePath."/sponsorship/info/", "pageid" => "sponsorship-info", "content" => "")//,
			//array("title" => "List of Sponsors", "link" => $prependBasePath."/sponsorship/list/", "pageid" => "sponsorship-list", "content" => "")
		)
	),
	array("title" => "Resources", "link" => $prependBasePath."/resources/", "pageid" => "resources", "content" =>
		array(
			array("title" => "CAD Info", "link" => $prependBasePath."/resources/cad/", "pageid" => "resources-cad", "content" => ""),
			array("title" => "CADalog", "link" => $prependBasePath."/resources/cadalog/", "pageid" => "resources-cadalog", "content" => ""),
			array("title" => "Team/Competition Documents", "link" => $prependBasePath."/resources/teamdocs/", "pageid" => "resources-teamdocs", "content" => ""),
			array("title" => "Suppliers", "link" => $prependBasePath."/resources/suppliers/", "pageid" => "resources-suppliers", "content" => "")
		)
	),
	array("title" => "FIRST&reg;", "link" => $prependBasePath."/first/", "pageid" => "first", "content" => ""),
	//array("title" => "News", "link" => $prependBasePath."/news/", "pageid" => "news", "content" => ""),
	array("title" => "Contact Us", "link" => $prependBasePath."/contact/", "pageid" => "contact", "content" => "")
);
function writeMenu($menu) // This function outputs the menu, and recurses through it for subitems
{
	global $pageId;
	echo "\n	<ul id=\"menu\" class=\"sf-menu sf-navbar\">";
	for($i=0; $i<count($menu); $i++){
		$activePage = ($pageId==$menu[$i]["pageid"]?" class=\"activepage\"":null);
		if(is_array($menu[$i]["content"])){ //Checks if this item has submenus
			echo "\n		<li".$activePage."><a href=\"".$menu[$i]["link"]."\">".$menu[$i]["title"]."</a>";
			writeSubMenu($menu[$i]["content"]);
			echo "\n		</li>";
		}else{
		echo "\n		<li".$activePage."><a href=\"".$menu[$i]["link"]."\">".$menu[$i]["title"]."</a></li>";
		}
	}
	echo "\n	</ul>";
}
function writeSubMenu($submenu)
{
	global $pageId;
	echo "\n			<ul>";
	for($i=0; $i<count($submenu); $i++){
	$activeSubPage = ($pageId==$submenu[$i]["pageid"]?" class=\"activesubpage\"":null);
	echo "\n				<li".$activeSubPage."><a href=\"".$submenu[$i]["link"]."\">".$submenu[$i]["title"]."</a></li>";
	}
	echo "\n			</ul>";
}
writeMenu($menuarray);
/*class link
{
	public $link;
	public $title;
	public function _construct()
	{
		//construct
	}
	
}
class menu
{
	public $linkcollection = array();
	public $node;
	public $pointer = 0;
	public function _construct()
	{
		//This is the constructor
	}
	
	
	
}*/
?>
