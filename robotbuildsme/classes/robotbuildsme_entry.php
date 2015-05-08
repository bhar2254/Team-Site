<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of robotbuildsme_entry
 *
 * @author jacobc
 */
include_once('simple_html_dom.php');
class robotbuildsme_entry {
    public $id;
    public $person_name;
    public $team_number;
    public $team_name;
    public $location;
    public $personType;
    public $personType_other;
    public $emailAddress;
    public $entry;
    public $approvedToBePublic;
    
    public $createdDate;
    public $createdIP;
    public $userid;
    public $userobj;
    
    private $keys = array('id','person_name', 'team_number', 'location', 'personType', 'personType_other', 'emailAddress', 'entry', 'createdDate', 'createdIP', "approvedToBePublic", "userid", "team_name");
    private $res; 
    private $dbh; //Database Connector.
    private $queryRan;
    private $recordExists = false;
    
    public $noName = false;
    public $noEmail = false;
    public $noLocation = false;
    public $noCreatedIP = false;
    
    public function __construct()
    {
        //This will construct the object.
        
    }
    public function setDBH($dbhIn)
    {
        $this->dbh = $dbhIn;
    }
    public function publishItem()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $id = &$this->id;
        if(isset($dbh))
        {
            if(!empty($id))
            {
                $query = "UPDATE entry SET \"approvedToBePublic\" = 't' WHERE id='$id'";
                $exec = pg_exec($dbh, $query);
            }
        }
        
        
    }
    public function retractItem()
    {
                $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $id = &$this->id;
        if(isset($dbh))
        {
            if(!empty($id))
            {
                $query = "UPDATE entry SET \"approvedToBePublic\" = 'f' WHERE id='$id'";
                $exec = pg_exec($dbh, $query);
            }
        }
    }
    public function doesRecordExist()
    {
        return $this->recordExists;
    }
    public function addViewToPost()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $id = &$this->id;
        //We will add this to the view log.
        $query = "INSERT into entry_view_tracker (postid, client_address) VALUES ('$id', '$ipaddress')";
        $exec = pg_exec($dbh, $query);
    }
    public function retrieveRecordByID()
    {
       //This can retrieve a record from a database.
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $res= &$this->res;
        $id = &$this->id;
        if(isset($dbh))
        {
            if(!empty($id))
            {
                $query = "SELECT * FROM entry";
                $query .= " WHERE id='$id'";
                $exec = pg_exec($dbh, $query);
                $numrows = pg_numrows($exec);
                if($numrows > 0)
                {
                    $this->recordExists = true;
                    $res = pg_fetch_all($exec);
                    $r = $res[0];
                    $this->populateFromResIn($r);
                }
            }

        }
    }
    public function populateFromResIn($resIn)
    {
        $keys = &$this->keys;
        foreach($keys as $k)
        {
            $code = "\$this->" . $k . " = \$resIn['$k'];";
            eval($code);
        }
    }
    public function populateFromPostArray()
    {
        //This will pull the post array from PHP.
        //This assumes that the key variables are the same accross the board.
        $keys = &$this->keys;
        $pkeys = array_keys($_POST);
        //print_r($pkeys);
        //print_r($keys);
        //print_r($_POST);
        //This is a test comment.
        
        foreach($keys as $k)
        {
            if(in_array($k, $pkeys))
            {
                $code;
                if($k == "entry")
                {
                    $code = "\$this->" . $k . " = '" . $_POST[$k] . "';";
                }
                else{
                    $code = "\$this->" . $k . "= '" . htmlspecialchars(chop($_POST[$k]), ENT_QUOTES) . "';";
                }
                eval($code);
            }
        }
    }
    
    public function generateID()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $id = &$this->id;
        if(isset($this->dbh))
        {
            $query = "SELECT nextval('entry_id_seq')";
            $exec = pg_exec($dbh, $query);
            $numrows = pg_numrows($exec);
            if($numrows > 0)
            {
                $res = pg_fetch_row();
                $id = $res[0];
            }
        }
    }
    public function createRecord()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $keys = &$this->keys;
        if(isset($dbh))
        {
            $q = new queryhelper();
            $q->tableName = "entry";
            $q->tmpObj = $this;
            $q->keys = $keys;
            $q->generateCondensedArray(false);
            $q->generateInsertQueryFromCondensed();
            $query = $q->queryWrote;
            
            $exec = pg_exec($dbh, $query);
        }
    }
    public function updateRecord()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $res = &$this->res;
        $id = &$this->id;
        $keys = &$this->keys;
        if(isset($dbh))
        {
            //Now that the database is set.
            if(!empty($id))
            {
                $q = new queryhelper();
                $q->tableName = "entry";
                $q->tmpObj = $this;
                $q->keyColum = "id";
                $q->keyValue = $id;
                $q->keys = $keys;
                $q->res = $res;
                
                $q->generateCondensedArray(true);
                $q->generateUpdateQueryFromCondensed();
                //print_r($q->condensed);
                //echo "<pre>";
                //print_r($q);
                //echo "</pre>";
                $query = $q->queryWrote;
                
                $exec = pg_exec($dbh, $query);
                
            }
        }
    }
    public function encodeToJSON()
    {
        $keys = $this->keys;
        if($this->noEmail)
        {
            $k = array_search("emailAddress", $keys);
            unset($keys[$k]);
        }
        if($this->noLocation)
        {
            $k = array_search("location", $keys);
            unset($keys[$k]);
        }
        if($this->noName)
        {
            $k = array_search("person_name", $keys);
            unset($keys[$k]);
        }
        if($this->noCreatedIP)
        {
            $k = array_search("createdIP", $keys);
            unset($keys[$k]);
        }
        //print_r($keys);
        $jsonTmp = array();
        foreach($keys as $k)
        {
            
            $code = "\$jsonTmp['$k'] = \$this->" . $k . ";";
            eval($code);
        }
        return json_encode($jsonTmp);
    }
    public function bundleToArray()
    {
        $keys = &$this->keys;
        $arrTmp = array();
        foreach($keys as $k)
        {
            $code = "\$arrTmp['$k'] = \$this->" . $k . ";";
            eval($code);
        }
        return $arrTmp;
    }
    public function returnShortDate()
    {
        $dateIn = &$this->createdDate;
        if(!empty($dateIn))
        {
            $date = strtotime($dateIn);
            //return date("r", $date);
            return date("n/j/Y",$date);
        }
        return null;
    }
    public function shortenEntryText()
    {
        $entry = &$this->entry;
        $out = "";
        $maxLen = 550;
        
        if(!empty($entry))
        {
            //Than lets use html dom to parse.
            $html = str_get_html($entry);
            $firstParagraph = $html->find('p',0);
            //Lets check the text of the first paragraph to make sure we are good.
            $out = $firstParagraph->plaintext;
            
            $len = strlen($out);
            if($len > $maxLen)
            {
                $out = substr($out, 0, $maxLen);
                $out .= "...";
            }
            $html = null;
            unset($html);
            return $out;
        }
        return null;
    }
    public function renderHTMLOutput()
    {
        $out = '';
        $person_name = &$this->person_name;
        $team_number = &$this->team_number;
        $team_name = $this->team_name;
        $location = &$this->location;
        $personType = &$this->personType;
        $personType_other = &$this->personType_other;
        $emailAddress = &$this->emailAddress;
        $entry = &$this->entry;
        $out .= '<table id="robotBuildsMeEntryTbl">
            ';
        if(!$this->noName)
        {
            $out .= '  <tr>
                    <td>
                        <strong>Name</strong>
                    </td>
                </tr>
                <tr>
                    <td>' . $person_name . '</td>
                </tr>';
        }
        $out .= '
            <tr>
                <td>
                    <strong>Team Number</strong>
                </td>
            </tr>
            <tr>
                <td>
                    ' . $team_number . '
                </td>
            </tr>';
        if(!empty($team_name))
        {
            $out .= '<tr>
                <td><strong>Team Name</strong></td>
                </tr>
                <tr>
                <td>' . $team_name . '</td></tr>';
        }
        if(!$this->noLocation)
        {
        $out .= '
            <tr>
                <td>
                    <strong>Location</strong>
                </td>
            </tr>
            <tr>
                <td>' . $location . '</td>
            </tr>';
        }
        $out .= '
            <tr>
                <td>
                    <strong>Select One:</strong>
                </td>
            </tr>
            <tr>
                <td>';
                if($personType == "Member")
                {
                    $out .= "<strong>Member</strong>";
                }
                 else 
                     {
                        $out .= "Member"; 
                     
                     }
                 $out .= "&nbsp;";
                 if($personType == "Mentor")
                 {
                     $out .= "<strong>Mentor</strong>";
                 } 
                 else
                 {
                     $out .= "Mentor";
                 }
                 $out .= "&nbsp;";
                 if($personType == "Parent")
                 {
                     $out .= "<strong>Parent</strong>";
                 } 
                 else 
                 {
                     $out .= "Parent";
                 }
                 $out .= "&nbsp;";
                 if($personType == "Coach")
                 { 
                     $out .= "<strong>Coach</strong>";
                 }
                 else 
                 { 
                     $out .= "Coach"; 
                  
                 }
                 $out .= "&nbsp;";
                 if($personType == "Other") { 
                     $out .= "<strong>Other</strong>";
                     if(!empty($personType_other))
                     {
                         $out .= " - " . $personType_other;
                     }
                 }
                 else {

                     $out .= "Other";
                 }

            //     $out .= "&nbsp;";
//            $out .= '    Member
//                    &nbsp;
//                    Mentor
//                    &nbsp;
//                    Parent
//                    &nbsp;
//                    Coach
//                    &nbsp;';
//            $out .= '
//                    Other:
//                    ';
            $out .= '    </td>
            </tr>';
            if(!$this->noEmail)
            {
                $out .= '
                <tr>
                    <td><strong>Email Address</strong> (So we can send you a copy):</td>
                </tr>
                <tr>
                    <td>' . $emailAddress . '</td>
                </tr>';
            }
            $out .= '
            <tr>
                <td><strong>Entry</strong></td>
            </tr>
            <tr>
                <td>
                    ' . $entry . '
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
            </tr>
        </table>';
        
        return $out;
    }
    
}

?>
