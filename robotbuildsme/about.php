<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('common.php');

include('base/stylehelperBase.php');
$pgCustomFooterScript = "$('.myCarousel').carousel();";
$pgNavActive = "About";

writeHtmlHead();
writeBeginningBody();
?>
<div class="row-fluid">
	<h1>About Robot Builds Me</h1>
	<p>Participating in FIRST<sup>&reg;</sup> Robotics does more than teach you how to use a wrench or how to write a paper. FIRST<sup>&reg;</sup> teaches students, as well as coaches, mentors, and even parents immeasurable skills. These skills go beyond the classroom and workshop. They include leadership, teamwork, honor, gracious professionalism, Coopertition, perseverance, and confidence.</p>
	<p>FIRST<sup>&reg;</sup> Robotics has affected people in unimaginable ways. Those who participate are not just tech-nerds and geeks.  They are people who found a group of like-minded individuals to call family. People who came to robotics to learn engineering or fill a spot on a college resume, and found friends, experience, and potential in themself. People who can honestly say: &quot;The Robot Builds Me.&quot;</p>
	<p>To show this to the community, we have begun to collect testimonials from team members, mentors, coaches, and parents from teams around the world. We compile these testimonials into publications that we bring to presentations and public events. Take a look through one of our booklets. You will read amazing and honest stories written by your peers. If you feel that you could contribute to our collection, feel free to write your story down and hand it to us at competition or email us at <a href="mailto:first1764@gmail.com?Subject=Robot%20Builds%20Me">first1764@gmail.com</a>.</p>
</div>
<?php
writeEndingBody();
writeEndingHtml();
?>