<?php

/*
 * This is the submission form for the robot builds me.
 * 
 */
require_once('common.php');
include('base/stylehelperBase.php');
include_once('classes/dbconn.inc.php');
include_once('classes/queryhelper.php');
include_once('classes/robotbuildsme_entry.php');


$pgCustomFooterScript = "$('.myCarousel').carousel();";
$pgNavActive = "Submit";
$pgCustomHeadScript = file_get_contents("extra-javascripts/submit-form-script.js");
writeHtmlHead();
writeBeginningBody();
$submitted = false;
if($_POST['sendEntry'] == "Submit")
{
    $submitted = true;
}
if($submitted)
{
    $dbh = returnDBH();
    ?>
<div class="row-fluid">
    <div class="span10">
        <!--<pre>
           <?php //var_dump($_POST);
        $rbmEntry = new robotbuildsme_entry();
        $rbmEntry->setDBH($dbh);
        $rbmEntry->createdIP = $_SERVER['REMOTE_ADDR'];
        $rbmEntry->createdDate = date();
        $rbmEntry->populateFromPostArray();
        $rbmEntry->person_name = $_POST['person_name'];
        $rbmEntry->createdDate = "NOW()";
        $rbmEntry->generateID();
        $rbmEntry->createRecord();
        
        //var_dump($rbmEntry);
            ?>
        </pre>-->
    </div>
</div>
<div class="row-fluid">
    <div class="span10">
        <h2>Thank you for your submission.</h2>
    </div>
</div>
    <?php
}
else
{
?>
<div class="row-fluid">
    <div class="span10">
        <!--Begin Submission Form-->
        <form method="post" id="userSubmissionForm" class="form-horizontal">
            <div class="control-group" id="person_name_group">
                <label class="control-label" for="person_name">Name</label>
                <div class="controls">
                    <input type="text" id="person_name" name="person_name" value="" />
                </div>
            </div>
            <div class="control-group" id="team_number_group">
                <label class="control-label" for="team_number">Team Number</label>
                <div class="controls">
                    <input type="text" id="team_number" name="team_number" value="" onchange="getTeamInfoFromUserInput(this.value)"/>
                </div>
            </div>
            <div class="control-group" id="team_name_group">
                <label class="control-label" for="team_name">Team Name</label>
                <div class="controls">
                    <input type="text" id="team_name" name="team_name" value="" />
                </div>
            </div>
            <div class="control-group" id="location_group">
                <label class="control-label" for="location">Location</label>
                <div class="controls">
                    <input type="text" id="location" name="location" value="" />
                </div>
            </div>
            <div class="control-group" id="emailAddress_group">
                <label class="control-label" for="emailAddress">Email</label>
                <div class="controls">
                    <input type="email" id="emailAddress" name="emailAddress" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Select One:</label>
            </div>
            <div class="control-group">
                
                <div class="controls">
                    <label class="radio inline">Member <input type="radio" name="personType" id="personType_a" value="Member" /></label>
                    
                    <label class="radio inline">Mentor <input type="radio" name="personType" id="personType_b" value="Mentor" /></label>
                    
                    <label class="radio inline">Parent <input type="radio" name="personType" id="personType_c" value="Parent" /></label>
                    
                    <label class="radio inline">Coach <input type="radio" name="personType" id="personType_d" value="Coach" /></label>
                    <label class="radio inline">Alumni <input type="radio" name="personType" id="personType_f" value="Alumni" /></label>
                    
                    <label class="radio">Other: <input type="radio" name="personType" id="personType_e" value="Other" />
                    <input type="text" name="personType_other" id="personType_other" value="" /></label>
                </div>
            </div>
            <div class="control-group" id="entry_group">
                <label class="control-label" for="entry">Entry</label>
                <div class="controls">
                    <textarea id="entry" name="entry"></textarea>
                </div>
            </div>
            <div class="control-group">
                <div class="control">
                <button type="submit" name="sendEntry" id="sendEntry" class="btn-success" value="Submit" />Submit Entry</button>
                </div>
            </div>
        </form>
        <!--End Submission Form-->
    </div>
</div>

<?php
}
writeEndingBody();
writeEndingHtml();
?>
