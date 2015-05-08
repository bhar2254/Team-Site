<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of robotbuildsme_entry_collection
 *
 * @author jacobc
 */
class robotbuildsme_entry_collection {
    //put your code here
    private $dbh;
    private $queryRan;
    
    public $publicOnly = false;
    
    public $teamnumber;
    public $teamname;
    public $location;
    public $person_name;
    public $emailAddress;
    public $ipaddress;
    public $entry;
    public $personType;
    public $table;
    
    private $qb;
    private $exactVals;
    private $res;
    
    private $objRes = array();
    
    public $numrows = 0;
    public $limitResultsTo = 0; // Number of rows anything greater than 0 will be limited.
    public $sortby = array("");
    public $softbystr = "";
    public $offsetPointer = 0;
    
    public $implementNaturalSearch = true;
    
    public function __construct() {
        //This is the constructor.;
        $this->table = "entry_summary_count";
    }
    public function setDBH($dbhIn)
    {
        $this->dbh = $dbhIn;
    }
    public function renderResObjects()
    {
        $res = &$this->res;
        $objRes = &$this->objRes;
        if(count($res)>0)
        {
            foreach($res as $r)
            {
                $rb = new robotbuildsme_entry();
                $rb->populateFromResIn($r);
                array_push($objRes, $rb);
                $rb = null;
                unset($rb);
                
            }
        }
    }
    public function getObjects()
    {
        return $this->objRes;
    }
    public function renderCSVOfResults()
    {
        $res = &$this->res;
        
        return "Comming Soon";
    }
    public function renderHtmlTableOfResults()
    {
        $res = &$this->res;
        return "Coming Soon";
    }
    public function returnJSONRenderedResults()
    {
        $res = &$this->res;
        $objs = &$this->objRes;
        //$jsonOut = array();
        $jsonOut = "[";
        if(count($objs) > 0)
        {
            $count = count($objs);
            $ekc = $count - 1;
            for($i=0; $i<$count; $i++)
            {
                $ent = $objs[$i];
                $jsonOut .= $ent->encodeToJSON();
                if($i != $ekc)
                {
                    $jsonOut .= ",";
                }
                $ent = null;
                unset($ent);
            }
        }
        $jsonOut .= "]";
        return $jsonOut;
        
    }
    public function getResults()
    {
        $dbh = &$this->dbh;
        $query = &$this->queryRan;
        $res = &$this->res;
        if(isset($dbh))
        {
            if($query)
            {
                $exec = pg_exec($dbh, $query);
                $numrows = pg_numrows($exec);
                $this->numrows = $numrows;
                if($numrows > 0)
                {
                    $res = pg_fetch_all($exec);
                    $this->renderResObjects();
                }
            }
        }
    }
    public function generateQueryFromCondArray()
    {
        $query = &$this->queryRan;
        $qb = &$this->qb;
        $exactVals = &$this->exactVals;
        $table = &$this->table;
        $sortbyStr = &$this->softbystr;
        
        $query = "SELECT * FROM $table";
        
        if($this->publicOnly == true)
        {
            
            $qb['approvedToBePublic'] = 'true';
        }
        
        if(count($qb) > 0)
        {
            $query .= " WHERE ";
            $keys = array_keys($qb);
            $ekc = count($qb) - 1;
            for($i=0; $i<count($qb); $i++)
            {
                $k = $keys[$i];
                if(in_array($k, $exactVals))
                {
                   $query .= "\"";
                   $query .= $keys[$i];
                   $query .= "\"";
                   $query .= " = ";
                   $query .= "'";
                   $query .= $qb[$keys[$i]];
                   $query .= "'";
                }
                else
                {
                    $query .= "\"";
                    $query .= $keys[$i];
                    $query .= "\"";
                    $query .= " iLike ";
                    $query .= "'%";
                    $query .= $qb[$keys[$i]];
                    $query .= "%'";
                }
                
                if($i != $ekc)
                {
                    $query .= " AND ";
                }
            }
        }
        
        if(!empty($sortbyStr))
        {
            $query .= " ORDER BY " . $sortbyStr;
        }
        
        
        
        
    }
    public function generateCountQuery()
    {
        $query = &$this->queryRan;
        $qb = &$this->qb;
        $exactVals = &$this->exactVals;
        $table = &$this->table;
        $query = "SELECT count(*) FROM $table";
        
        if($this->publicOnly == true)
        {
            
            $qb['approvedToBePublic'] = 'true';
        }
        
        if(count($qb) > 0)
        {
            $query .= " WHERE ";
            $keys = array_keys($qb);
            $ekc = count($qb) - 1;
            for($i=0; $i<count($qb); $i++)
            {
                $k = $keys[$i];
                if(in_array($k, $exactVals))
                {
                   $query .= "\"";
                   $query .= $keys[$i];
                   $query .= "\"";
                   $query .= " = ";
                   $query .= "'";
                   $query .= $qb[$keys[$i]];
                   $query .= "'";
                }
                else
                {
                    $query .= "\"";
                    $query .= $keys[$i];
                    $query .= "\"";
                    $query .= " iLike ";
                    $query .= "'%";
                    $query .= $qb[$keys[$i]];
                    $query .= "%'";
                }
                
                if($i != $ekc)
                {
                    $query .= " AND ";
                }
            }
        }
        
    }
    public function executeCountQuery()
    {
        $query = &$this->queryRan;
        $dbh = &$this->dbh;
        if(isset($dbh))
        {
            $exec = pg_exec($dbh, $query);
            $res = pg_fetch_row($exec);
            $this->numrows = $res[0];
        }
    }
    public function generateConditionalArray()
    {
        $query = &$this->queryRan;
        
        $teamname = &$this->teamname;
        $teamnumber = &$this->teamnumber;
        $location = &$this->location;
        $person_name = &$this->person_name;
        $emailAddress = &$this->emailAddress;
        $entry = &$this->entry;
        $ipaddress = &$this->ipaddress;
        $personType = &$this->personType;
        $table = &$this->table;
        $qb = &$this->qb;
        $exactVals = &$this->exactVals;
        
        
        $qb = array();
        $exactVals = array("team_number", "personType", "approvedToBePublic");
        
        if($teamname)
        {
            $qb['team_name'] = $teamname;
        }
        if($teamnumber)
        {
            $qb['team_number'] = $teamnumber;
        }
        if($location)
        {
            $qb['location'] = $location;
        }
        if($emailAddress)
        {
            $qb['emailAddress'] = $emailAddress;
        }
        if($entry)
        {
            $qb['entry'] = $entry;
            
        }
        if($person_name)
        {
            $qb['person_name'] = $person_name;
        }
        if($personType)
        {
            $qb['personType'] = $personType;
        }
        
        //Now lets write the query.
       
        
        
    }
}

?>
