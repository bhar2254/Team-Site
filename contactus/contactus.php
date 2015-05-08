	<div class="container-fluid marketing">
    <div class="container">
      <div class="row-fluid">
        <!--<div data-spy="affix" class="span3 bs-docs-sidebar">
        <ul class="nav nav-list bs-docs-sidenav">
          <li><a href="#1"><i class="icon-chevron-right"></i>Cow Town Throwdown</a></li>
          <li><a href="#2"><i class="icon-chevron-right"></i>Kansas City Regionals</a></li>
          <li><a href="#3"><i class="icon-chevron-right"></i>2010-2011</a></li>
          <li><a href="#4"><i class="icon-chevron-right"></i>2009-2010</a></li>
          <li><a href="#5"><i class="icon-chevron-right"></i>2008-2009</a></li>
        </ul>
      </div>-->
        <div class="offset 1 span11">
		<div class="page-header">
			<h1><?php echo $pageTitle?></h1>
		</div>
		  <div>
		  
		  
		  <?php $form='<form action="index.php" method="post"><table>
	<tr><td>Your Name:&nbsp;&nbsp;</td><td><input class="input-xlarge" type="text" name="msgname" value="'.$_POST["msgname"].'" /></td></tr>
	<tr><td>Your Email:&nbsp;&nbsp;</td><td><input class="input-xlarge" type="text" name="msgemail" value="'.$_POST["msgemail"].'" /></td></tr>
	<tr><td>Subject:&nbsp;&nbsp;</td><td><input class="input-xlarge" type="text" name="msgsubject" value="'.$_POST["msgsubject"].'" /></td></tr>
	<tr><td>Message Content:&nbsp;&nbsp;</td><td><textarea class="input-xlarge" name="msgcontent" rows="6" cols="30">'.$_POST["msgcontent"].'</textarea></td></tr></table>
	<input class="btn" style="margin-left:226px" type="submit" value="Send message" />
</form>';
if(($_POST["msgsubject"]!=null)&&($_POST["msgemail"]!=null)&&($_POST["msgname"]!=null)&&($_POST["msgcontent"]!=null)){
	//$ToEmail = 'jcarter@liberty.k12.mo.us'; 
	//$EmailSubject = 'RCF - '.$_POST["msgsubject"]; 
	//$mailheader = "From: ".$_POST["msgemail"]."\r\n"; 
	//$mailheader .= "Reply-To: ".$_POST["msgemail"]."\r\n"; 
	//$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$MESSAGE_BODY = "<strong>Reply Name:</strong> ".$_POST["msgname"]."<br>"; 
	$MESSAGE_BODY .= "<strong>Reply Email:</strong> ".$_POST["msgemail"]."<br>"; 
	$MESSAGE_BODY .= "<strong>Message:</strong> ".nl2br($_POST["msgcontent"])."<br>";
			$mail = new PHPMailer();
				$mail->From = "webmaster@liberty.k12.mo.us";
				$mail->FromName = "Webmaster";
				$mail->Host = "localhost";
				$mail->Mailer = "smtp";
				$mail->Body = $MESSAGE_BODY;
				$mail->Subject = "Robotics Site Feedback ".$_POST["msgsubject"];
				$mail->AddAddress("first1764@liberty.k12.mo.us", "Team Email");
				$mail->isHTML(true);
				$mail->IsSendmail();
				$mail->Send();
	//mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or $error="Failure to send message.";
	echo "<strong>Your message has been sent. We appreciate your input and support. Thank you.</strong><br/>";
}elseif(($_POST["msgsubject"]!=null)||($_POST["msgemail"]!=null)||($_POST["msgname"]!=null)||($_POST["msgcontent"]!=null)){
	if($_POST["msgsubject"]==null){
		$error.="<strong>Please add a subject to your message.</strong><br/>";
	}
	if($_POST["msgemail"]==null){
		$error.="<strong>Please add a return email to your message.</strong><br/>";
	}
	if($_POST["msgname"]==null){
		$error.="<strong>Please add a name to your message.</strong><br/>";
	}
	if($_POST["msgcontent"]==null){
		$error.="<strong>Please add content to your message.</strong><br/>";
	}
	$pagecontent=$form;
}else{
	$pagecontent=$form;
}
echo $error;
echo $pagecontent;
?>

		<br/>
		<h2>By Mail:</h2><br/>
		<p>Gary Pierson, Head Coach<br/>
			Liberty High School<br/>
	        200 Bluejay Drive<br/>
	        Liberty MO, 64068-3810 <br/>
	        <br/>
		</p>
		<h2>Electronically:</h2><br/>
		<b>Team Email</b><br/>
        <a href="mailto:first1764@gmail.com">first1764@gmail.com</a>
		<br/>
		<br/>
		<b>Twitter</b><br/>
        <a href="https://twitter.com/FRC1764" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @FRC1764</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<br/>
		<br/>
		<b>Facebook</b><br/>
		<div class="fb-like" data-send="false" data-layout="standard" data-width="450" data-show-faces="false" data-colorscheme="light" data-action="like"></div>
		<div class="fb-follow" data-layout="standard" data-show-faces="false" data-colorscheme="light" data-width="450"></div>
		</div>
        </div><!--/span-->
      </div><!--/row-->
    </div><!--/.fluid-container-->
	</div><!--/Marketing-->