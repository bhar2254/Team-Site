<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
    if(isset($_SESSION['userobj']))
    {
        $u = unserialize($_SESSION['userobj']);
        
    }
    else
    {
        echo "Please login to the site";
        session_destroy();
        exit;
    }
include('../common.php');
include('../classes/dbconn.inc.php');
include('../classes/queryhelper.php');
include('../classes/robotbuildsme_entry.php');

$pageTitle = "The Robot Builds Me";
$dbh = returnDBH();

include('../base/stylehelperBase.php');

if($_POST['sendEntry'] == "Edit")
{
    $id = $_GET['id'];
    if(!empty($id))
    {
            $id = htmlspecialchars(chop($id), ENT_QUOTES);
            $rbmEntry = new robotbuildsme_entry();
            $rbmEntry->setDBH($dbh);
            $rbmEntry->id = $id;
            $rbmEntry->retrieveRecordByID();

            //$rbmEntry->createdIP = $_SERVER['REMOTE_ADDR'];
            //$rbmEntry->createdDate = date();
            $rbmEntry->populateFromPostArray();
            //$rbmEntry->person_name = $_POST['person_name'];
            //$rbmEntry->createdDate = "NOW()";
            //$rbmEntry->generateID();
            //$rbmEntry->createRecord();

            //echo $rbmEntry->renderHTMLOutput();
            $rbmEntry->updateRecord();
            //var_dump($rbmEntry);
            writeHtmlHead();
            writeBeginningBody();
            ?>
                <div class="row-fluid">
    <ul class="breadcrumb">
        <li><a href="/robotbuildsme/index.php">Robot Builds Me</a> <span class="divider">/</span></li>
        <li class="active"><a href="/robotbuildsme/admin/list.php">Admin - View Entries</a> <span class="divider">/</span></li>

    </ul>
</div>
<div class="row-fluid">
    <div class="span10">
            <?php
            echo $rbmEntry->renderHTMLOutput();
            ?>
    </div>
    <?php
    }
}
else
{
        $rbmEntry = new robotbuildsme_entry();
        $id = $_GET['id'];
        $exists = false;
        if(!empty($id))
        {
            $id = htmlspecialchars(chop($id), ENT_QUOTES);
            $rbmEntry->setDBH($dbh);
            $rbmEntry->id = $id;
            $rbmEntry->retrieveRecordByID();
            $exists = $rbmEntry->doesRecordExist();
        }
        writeHtmlHead();
        writeBeginningBody();
        if($exists)
        {
            ?>
<div class="row-fluid">
    <ul class="breadcrumb">
        <li><a href="/robotbuildsme/index.php">Robot Builds Me</a> <span class="divider">/</span></li>
        <li class="active"><a href="/robotbuildsme/admin/list.php">Admin - View Entries</a> <span class="divider">/</span></li>
        <li class="active"><?= $rbmEntry->personType . " - " . $rbmEntry->person_name . " - " . $rbmEntry->team_number; ?></li>
    </ul>
</div>
    <div class="row-fluid">
        <div class="span10">
            <!-- Begin Options -->
            
            <!-- End Options -->
        </div>
    </div>
    <div class="row-fluid">
        <div class="span10">
            <!-- Begin Edit Form -->
            <form method="post">
        <table>
            <tr>
                <td>
                    <label>Name</label>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="person_name" id="person_name" style="width:304px;" value="<?= $rbmEntry->person_name; ?>"/></td>
            </tr>
            <tr>
                <td>
                    <label>Team Number</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="team_number" id="team_number" style="width:304px;" value="<?= $rbmEntry->team_number; ?>" onchange="getTeamInfoFromUserInput(this.value);"/>
                </td>
            </tr>
            <tr class="teamnameTR" id="teamNameLbr">
                <td><label>Team Name</label></td>
                
            </tr>
            <tr class="teamnameTR" id="teamNameField">
                <td><input type="text" name="team_name" id="team_name" style="width:304px;" value="<?= $rbmEntry->team_name; ?>"/></td>
            </tr>
            <tr>
                <td>
                    <label>Location</label>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="location" id="location" style="width:304px;" value="<?= $rbmEntry->location; ?>"/></td>
            </tr>
            <tr>
                <td>
                    <label>Select One:</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Member</label> <input type="radio" name="personType" id="personType_a" value="Member" <?php if($rbmEntry->personType == "Member") { echo "checked=\"yes\""; } ?> />
                    &nbsp;
                    <label>Mentor</label> <input type="radio" name="personType" id="personType_b" value="Mentor" <?php if($rbmEntry->personType == "Mentor") { echo "checked=\"yes\""; } ?>/>
                    &nbsp;
                    <label>Parent</label> <input type="radio" name="personType" id="personType_c" value="Parent" <?php if($rbmEntry->personType == "Parent") { echo "checked=\"yes\""; } ?>/>
                    &nbsp;
                    <label>Coach</label> <input type="radio" name="personType" id="personType_d" value="Coach" <?php if($rbmEntry->personType == "Coach") { echo "checked=\"yes\""; } ?>/>
                    &nbsp;
                    <label>Alumni</label><input type="radio" name="personType" id="personType_f" value="Alumni" <?php if($rbmEntry->personType == "Alumni") { echo "checked=\"yes\""; } ?>/>
                    &nbsp;
                    <label>Other:</label><input type="radio" name="personType" id="personType_e" value="Other" <?php if($rbmEntry->personType == "Other") { echo "checked=\"yes\""; } ?>/>
                    <input type="text" name="personType_other" id="personType_other" value="<?= $rbmEntry->personType_other; ?>" />
                </td>
            </tr>
            <tr>
                <td><label>Email Address</label> (So we can send you a copy):</td>
            </tr>
            <tr>
                <td><input type="text" name="emailAddress" id="emailAddress" style="width:304px;" value="<?= $rbmEntry->emailAddress; ?>"/></td>
            </tr>
            <tr>
                <td><label>Entry</label></td>
            </tr>
            <tr>
                <td>
                    <?php //$ckeditor->editor('entry', $rbmEntry->entry); ?>
                    <textarea id="entry" name="entry" style="width:469px; height:194px;"><?= $rbmEntry->entry; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="sendEntry" id="sendEntry" value="Edit" class="btn-large"/>
                </td>
            </tr>
        </table>
    </form>
            <!-- End Edit Form -->
        </div>
    </div>

            <?php
        }
        else
        {
            ?>
   <div class="row-fluid">
        <ul class="breadcrumb">
            <li><a href="/robotbuildsme/index.php">Robot Builds Me</a> <span class="divider"></span></li>
            <li><a href="/robotbuildsme/admin/list.php">Admin - View Entries</a> <span class="divider"></span></li>
            <li class="active">Not Found</li>
            
        </ul>
    </div>
    <div class="row-fluid">
        <div class="span10">
            <h2>Record Not Found</h2>
            <p>
                
            </p>
        </div>
    </div>
    <?php
        }
        writeEndingBody();
        writeEndingHtml();
}
?>
